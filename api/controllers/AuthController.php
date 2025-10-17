<?php
/**
 * Authentication Controller
 * Handle authentication-related operations
 */

require_once __DIR__ . '/../config/cors.php';
require_once __DIR__ . '/../models/Student.php';
require_once __DIR__ . '/../utils/Response.php';
require_once __DIR__ . '/../utils/Validator.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

CorsConfig::setup();

class AuthController
{
    private $studentModel;
    
    public function __construct()
    {
        $this->studentModel = new Student();
    }
    
    /**
     * Handle user login
     */
    public function login()
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            
            // Validate required fields
            $errors = Validator::validateRequired($data, ['username', 'password']);
            if (!empty($errors)) {
                Response::validationError($errors);
            }
            
            // Sanitize input
            $username = Validator::sanitize($data['username']);
            $password = $data['password'];
            
            // Find user by username or email
            $user = $this->studentModel->findByUsername($username);
            if (!$user) {
                $user = $this->studentModel->findByEmail($username);
            }
            
            if (!$user || !$this->studentModel->verifyPassword($user['password'], $password)) {
                Response::error('Invalid username/email or password', 401);
            }
            
            if (!$user['is_active']) {
                Response::error('Account is deactivated. Please contact administrator.', 403);
            }
            
            // Set user session
            AuthMiddleware::setUserSession($user);
            
            // Remove password from response
            unset($user['password']);
            
            Response::success($user, 'Login successful');
            
        } catch (Exception $e) {
            Response::serverError($e->getMessage());
        }
    }
    
    /**
     * Handle user registration
     */
    public function register()
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            
            // Required fields for registration
            $requiredFields = [
                'username', 'email', 'password', 'first_name', 'last_name',
                'birthdate', 'gender', 'student_no', 'year_level', 'college', 'program'
            ];
            
            // Validate required fields
            $errors = Validator::validateRequired($data, $requiredFields);
            
            // Validate email format
            if (isset($data['email']) && !Validator::validateEmail($data['email'])) {
                $errors['email'] = 'Invalid email format';
            }
            
            // Validate password strength
            if (isset($data['password'])) {
                $passwordErrors = Validator::validatePassword($data['password']);
                if (!empty($passwordErrors)) {
                    $errors['password'] = $passwordErrors;
                }
            }
            
            // Validate date format
            if (isset($data['birthdate']) && !Validator::validateDate($data['birthdate'])) {
                $errors['birthdate'] = 'Invalid date format. Use YYYY-MM-DD';
            }
            
            // Validate gender enum
            if (isset($data['gender']) && !Validator::validateEnum($data['gender'], ['Male', 'Female', 'Other'])) {
                $errors['gender'] = 'Invalid gender value';
            }
            
            // Validate phone if provided
            if (!empty($data['phone']) && !Validator::validatePhone($data['phone'])) {
                $errors['phone'] = 'Invalid phone number format';
            }
            
            if (!empty($errors)) {
                Response::validationError($errors);
            }
            
            // Sanitize input data
            $sanitizedData = Validator::sanitize($data);
            
            // Create student
            $student = $this->studentModel->create($sanitizedData);
            
            // Remove password from response
            unset($student['password']);
            
            Response::success($student, 'Registration successful', 201);
            
        } catch (Exception $e) {
            if (strpos($e->getMessage(), 'already exists') !== false) {
                Response::error($e->getMessage(), 409);
            } else {
                Response::serverError($e->getMessage());
            }
        }
    }
    
    /**
     * Handle user logout
     */
    public function logout()
    {
        try {
            AuthMiddleware::clearUserSession();
            Response::success(null, 'Logout successful');
        } catch (Exception $e) {
            Response::serverError($e->getMessage());
        }
    }
    
    /**
     * Get current user profile
     */
    public function getProfile()
    {
        try {
            $userId = AuthMiddleware::authenticate();
            $user = $this->studentModel->findById($userId);
            
            if (!$user) {
                Response::notFound('User not found');
            }
            
            // Remove password from response
            unset($user['password']);
            
            Response::success($user);
            
        } catch (Exception $e) {
            Response::serverError($e->getMessage());
        }
    }

    /**
     * Check login status
     * Returns current session user if logged in
     */
    public function checkLoginStatus()
    {
        try {
            $user = AuthMiddleware::getCurrentUser();

            if (!$user) {
                Response::success(['logged_in' => false], 'User not logged in');
                return;
            }

            Response::success([
                'logged_in' => true,
                'user' => $user
            ], 'User is logged in');
        } catch (Exception $e) {
            Response::serverError($e->getMessage());
        }
    }

    
    /**
     * Change password
     */
    public function changePassword()
    {
        try {
            $userId = AuthMiddleware::authenticate();
            $data = json_decode(file_get_contents("php://input"), true);
            
            // Validate required fields
            $errors = Validator::validateRequired($data, ['current_password', 'new_password']);
            if (!empty($errors)) {
                Response::validationError($errors);
            }
            
            // Validate new password strength
            $passwordErrors = Validator::validatePassword($data['new_password']);
            if (!empty($passwordErrors)) {
                Response::validationError(['new_password' => $passwordErrors]);
            }
            
            // Get current user
            $user = $this->studentModel->findById($userId);
            if (!$user) {
                Response::notFound('User not found');
            }
            
            // Verify current password
            if (!$this->studentModel->verifyPassword($user['password'], $data['current_password'])) {
                Response::error('Current password is incorrect', 400);
            }
            
            // Change password
            $result = $this->studentModel->changePassword($userId, $data['new_password']);
            
            if ($result) {
                $this->studentModel->markPasswordUpdated($userId);
                $_SESSION['password_updated'] = 1; // keep session in sync
                Response::success(null, 'Password changed successfully');
            } else {
                Response::serverError('Failed to change password');
            }
            
        } catch (Exception $e) {
            Response::serverError($e->getMessage());
        }
    }
    
    /**
     * Forgot password - initiate reset process
     */
    public function forgotPassword()
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);

            // Validate required fields
            $errors = Validator::validateRequired($data, ['student_no', 'new_password']);
            if (!empty($errors)) {
                Response::validationError($errors);
            }

            // Validate password strength
            $passwordErrors = Validator::validatePassword($data['new_password']);
            if (!empty($passwordErrors)) {
                Response::validationError(['new_password' => $passwordErrors]);
            }

            // Find user by student number
            $user = $this->studentModel->findByStudentNo($data['student_no']);
            if (!$user) {
                Response::error('Student number not found', 404);
            }

            // Change password
            $result = $this->studentModel->changePasswordByStudentNo($data['student_no'], $data['new_password']);
            if ($result) {
                Response::success(null, 'Password reset successfully');
            } else {
                Response::serverError('Failed to reset password');
            }


        } catch (Exception $e) {
            Response::serverError($e->getMessage());
        }
    }
}

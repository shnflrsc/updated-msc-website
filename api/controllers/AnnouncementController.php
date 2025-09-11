<?php

/**
 * Announcement Controller
 * Handle announcement-related operations
 */

require_once __DIR__ . '/../config/cors.php';
require_once __DIR__ . '/../models/Announcement.php';
require_once __DIR__ . '/../utils/Response.php';
require_once __DIR__ . '/../utils/Validator.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

CorsConfig::setup();

class AnnouncementController
{
    private $announcementModel;

    public function __construct()
    {
        $this->announcementModel = new Announcement();
    }

    /**
     * Create new announcement (Officer only)
     */
    public function create()
    {
        try {
            AuthMiddleware::requireOfficer();

            $data = [];
            $image_url = null;

            // Detect if request is multipart (file upload) or JSON
            if (!empty($_FILES) || isset($_POST['title'])) {
                // Handle multipart/form-data
                $data['title'] = $_POST['title'] ?? '';
                $data['content'] = $_POST['content'] ?? '';

                // Handle file upload if provided
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = __DIR__ . '/../uploads/';
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '_', basename($_FILES['image']['name']));
                    $targetPath = $uploadDir . $filename;

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                        $image_url = "/uploads/" . $filename;
                    }
                }
            } else {
                // Handle JSON (API clients)
                $data = json_decode(file_get_contents("php://input"), true);
                if (!$data) {
                    Response::validationError(['request' => 'Invalid JSON or empty request body']);
                }

                if (isset($data['image_url'])) {
                    $image_url = $data['image_url'];
                }
            }

            // Validate required fields
            $requiredFields = ['title', 'content'];
            $errors = Validator::validateRequired($data, $requiredFields);
            if (!empty($errors)) {
                Response::validationError($errors);
            }

            // Add posted_by
            $currentUser = AuthMiddleware::getCurrentUser();
            $data['posted_by'] = $currentUser['username'] ?? 'Admin';

            // Add image_url if available
            if ($image_url) {
                $data['image_url'] = $image_url;
            }

            // Sanitize
            $sanitizedData = Validator::sanitize($data);

            // Create announcement
            $announcement = $this->announcementModel->create($sanitizedData);

            Response::success($announcement, 'Announcement created successfully', 201);
        } catch (Exception $e) {
            Response::serverError($e->getMessage());
        }
    }


    /**
     * Get all announcements
     */
    public function getAll()
    {
        try {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 20;
            $includeArchived = isset($_GET['include_archived']) && $_GET['include_archived'] === 'true';

            // Only officers can view archived announcements
            if ($includeArchived) {
                AuthMiddleware::requireOfficer();
            }

            $announcements = $this->announcementModel->getAll($page, $limit, $includeArchived);
            $totalCount = $this->announcementModel->getTotalCount($includeArchived);

            Response::success([
                'announcements' => $announcements,
                'pagination' => [
                    'page' => $page,
                    'limit' => $limit,
                    'total' => $totalCount,
                    'total_pages' => ceil($totalCount / $limit)
                ]
            ]);
        } catch (Exception $e) {
            Response::serverError($e->getMessage());
        }
    }

    /**
     * Get announcement by ID
     */
    public function getById($id)
    {
        try {
            $announcement = $this->announcementModel->findById($id);

            if (!$announcement) {
                Response::notFound('Announcement not found');
            }

            // Check if announcement is archived and user has permission
            if ($announcement['is_archived']) {
                AuthMiddleware::requireOfficer();
            }

            Response::success($announcement);
        } catch (Exception $e) {
            Response::serverError($e->getMessage());
        }
    }

    /**
     * Update announcement (Officer only)
     */
    public function update($id)
    {
        try {
            AuthMiddleware::requireOfficer();

            $announcement = $this->announcementModel->findById($id);
            if (!$announcement) {
                Response::notFound('Announcement not found');
            }

            $data = [];
            $image_url = $announcement['image_url']; // keep existing image unless replaced

            // --- Try FormData first ---
            if (!empty($_POST) || !empty($_FILES)) {
                $data['title'] = $_POST['title'] ?? $announcement['title'];
                $data['content'] = $_POST['content'] ?? $announcement['content'];

                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = __DIR__ . '/../uploads/';
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '_', basename($_FILES['image']['name']));
                    $targetPath = $uploadDir . $filename;

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                        $image_url = "/uploads/" . $filename;
                    }
                }
            }

            // --- If FormData is empty, try JSON ---
            if (empty($data)) {
                $jsonData = json_decode(file_get_contents("php://input"), true);

                if (!empty($jsonData)) {
                    $data['title'] = $jsonData['title'] ?? $announcement['title'];
                    $data['content'] = $jsonData['content'] ?? $announcement['content'];

                    if (isset($jsonData['image_url'])) {
                        $image_url = $jsonData['image_url'];
                    }
                }
            }

            // Still nothing? Then reject
            if (empty($data)) {
                Response::validationError(['request' => 'No valid data provided (FormData or JSON)']);
            }

            // Validate required fields
            $requiredFields = ['title', 'content'];
            $errors = Validator::validateRequired($data, $requiredFields);
            if (!empty($errors)) {
                Response::validationError($errors);
            }

            // Add image_url
            $data['image_url'] = $image_url;

            // Sanitize
            $sanitizedData = Validator::sanitize($data);

            // Update announcement
            $result = $this->announcementModel->update($id, $sanitizedData);

            if ($result) {
                $updatedAnnouncement = $this->announcementModel->findById($id);
                Response::success($updatedAnnouncement, 'Announcement updated successfully');
            } else {
                Response::serverError('Failed to update announcement');
            }
        } catch (Exception $e) {
            Response::serverError($e->getMessage());
        }
    }


    /**
     * Archive announcement (Officer only)
     */
    public function archive($id)
    {
        try {
            AuthMiddleware::requireOfficer();

            $announcement = $this->announcementModel->findById($id);
            if (!$announcement) {
                Response::notFound('Announcement not found');
            }

            if ($announcement['is_archived']) {
                Response::error('Announcement is already archived', 400);
            }

            $result = $this->announcementModel->archive($id);

            if ($result) {
                Response::success(null, 'Announcement archived successfully');
            } else {
                Response::serverError('Failed to archive announcement');
            }
        } catch (Exception $e) {
            Response::serverError($e->getMessage());
        }
    }

    /**
     * Unarchive announcement (Officer only)
     */
    public function unarchive($id)
    {
        try {
            AuthMiddleware::requireOfficer();

            $announcement = $this->announcementModel->findById($id);
            if (!$announcement) {
                Response::notFound('Announcement not found');
            }

            if (!$announcement['is_archived']) {
                Response::error('Announcement is not archived', 400);
            }

            $result = $this->announcementModel->unarchive($id);

            if ($result) {
                Response::success(null, 'Announcement unarchived successfully');
            } else {
                Response::serverError('Failed to unarchive announcement');
            }
        } catch (Exception $e) {
            Response::serverError($e->getMessage());
        }
    }

    /**
     * Delete announcement (Officer only)
     */
    public function delete($id)
    {
        try {
            AuthMiddleware::requireOfficer();

            $announcement = $this->announcementModel->findById($id);
            if (!$announcement) {
                Response::notFound('Announcement not found');
            }

            $result = $this->announcementModel->delete($id);

            if ($result) {
                Response::success(null, 'Announcement deleted successfully');
            } else {
                Response::serverError('Failed to delete announcement');
            }
        } catch (Exception $e) {
            Response::serverError($e->getMessage());
        }
    }

    /**
     * Get recent announcements
     */
    // public function getRecent()
    // {
    //     try {
    //         $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    //         $announcements = $this->announcementModel->getRecent($limit);

    //         Response::success($announcements);

    //     } catch (Exception $e) {
    //         Response::serverError($e->getMessage());
    //     }
    // }

    public function getRecent($limit = null)
    {
        try {
            if ($limit === null) {
                $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
            }

            $announcements = $this->announcementModel->getRecent($limit);
            Response::success($announcements);
        } catch (Exception $e) {
            Response::serverError($e->getMessage());
        }
    }

    /**
     * Search announcements
     */
    public function search()
    {
        try {
            $query = isset($_GET['q']) ? trim($_GET['q']) : '';
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 20;

            if (empty($query)) {
                Response::validationError(['q' => 'Search query is required']);
            }

            $announcements = $this->announcementModel->search($query, $page, $limit);

            Response::success([
                'announcements' => $announcements,
                'pagination' => [
                    'page' => $page,
                    'limit' => $limit,
                    'query' => $query
                ]
            ]);
        } catch (Exception $e) {
            Response::serverError($e->getMessage());
        }
    }

    /**
     * COUNT: All Announcement
     */
    public function countAnnouncements()
    {
        $announcement = new Announcement();

        try {
            $count = $announcement->countAll();
            echo json_encode(['success' => true, 'data' => $count]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}

// Example: Announcement routes
$controller = new AnnouncementController();

$method = $_SERVER['REQUEST_METHOD'];
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Archive
if ($method === 'POST' && preg_match('#^/api/announcements/(\d+)/archive$#', $url, $matches)) {
    $controller->archive($matches[1]);

    // Unarchive
} elseif ($method === 'POST' && preg_match('#^/api/announcements/(\d+)/unarchive$#', $url, $matches)) {
    $controller->unarchive($matches[1]);
}

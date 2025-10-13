<?php
session_start();

// Include the new class-based database connection file
require_once './api/config/database.php';

// Get the database connection instance from the Database class
try {
    $conn = Database::getInstance()->getConnection();
} catch (Exception $e) {
    error_log("Failed to get database connection: " . $e->getMessage());
    die("We are experiencing technical difficulties. Please try again later.");
}

// Function to create a text snippet from a larger string
function makeSnippet($text, $length = 150) {
    $text = strip_tags($text); // Remove HTML tags
    if (mb_strlen($text) > $length) {
        $text = mb_substr($text, 0, $length) . "..."; // Truncate and add ellipsis
    }
    return htmlspecialchars($text); // Sanitize output
}

// Function to get all unique tags from the database
function getAllTags($conn) {
    try {
        $stmt = $conn->prepare("SELECT DISTINCT t.name FROM tags t JOIN announcement_tags at ON t.id = at.tag_id JOIN announcements a ON at.announcement_id = a.id WHERE a.is_archived = 0 AND t.name IS NOT NULL AND t.name != '' ORDER BY t.name ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching tags: " . $e->getMessage());
        return [];
    }
}

// Function to fetch announcements based on search term and tag filter
function getAnnouncements($conn, $searchTerm = '', $filterTag = '') {
    try {
        $sql = "
            SELECT a.id, a.title, a.content, a.created_at, a.image_path,
                   GROUP_CONCAT(DISTINCT t.name ORDER BY t.name SEPARATOR ', ') AS tags
            FROM announcements a
            LEFT JOIN announcement_tags at_join ON a.id = at_join.announcement_id
            LEFT JOIN tags t ON at_join.tag_id = t.id
            WHERE a.is_archived = 0
        ";
        
        $params = [];

        if (!empty($searchTerm)) {
            $sql .= " AND (a.title LIKE :search OR a.content LIKE :search OR a.id IN (
                        SELECT at_search.announcement_id 
                        FROM announcement_tags at_search
                        JOIN tags t_search ON at_search.tag_id = t_search.id
                        WHERE t_search.name LIKE :search_tag_name
                    ))";
            $params[':search'] = "%" . $searchTerm . "%";
            $params[':search_tag_name'] = "%" . $searchTerm . "%";
        }

        if (!empty($filterTag)) {
            $sql .= " AND a.id IN (
                SELECT at_filter.announcement_id 
                FROM announcement_tags at_filter
                JOIN tags t_filter ON at_filter.tag_id = t_filter.id
                WHERE t_filter.name = :filter_tag
            )";
            $params[':filter_tag'] = $filterTag;
        }

        $sql .= " GROUP BY a.id ORDER BY a.created_at DESC";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching announcements: " . $e->getMessage());
        return [];
    }
}

// Function to get a single announcement by its ID
function getAnnouncementById($conn, $id) {
    try {
        $sql = "
            SELECT a.id, a.title, a.content, a.created_at, a.image_path,
                   GROUP_CONCAT(DISTINCT t.name ORDER BY t.name SEPARATOR ', ') AS tags
            FROM announcements a
            LEFT JOIN announcement_tags at ON a.id = at.announcement_id
            LEFT JOIN tags t ON at.tag_id = t.id
            WHERE a.id = :id AND a.is_archived = 0
            GROUP BY a.id
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching announcement by ID $id: " . $e->getMessage());
        return false;
    }
}

// Get and sanitize search and filter parameters from the URL
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
$filterTag = isset($_GET['tag']) ? trim($_GET['tag']) : '';
$selectedId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch all available tags
$allTags = getAllTags($conn);
$announcements = [];
$focusedAnnouncement = null;
$pageTitle = "Announcements";

// Build a base query string for maintaining search/filter state on navigation
$queryStringParams = [];
if (!empty($searchTerm)) $queryStringParams['search'] = $searchTerm;
if (!empty($filterTag)) $queryStringParams['tag'] = $filterTag;
$baseQueryString = http_build_query($queryStringParams);

if ($selectedId > 0) {
    // If an ID is present, fetch a single announcement
    $focusedAnnouncement = getAnnouncementById($conn, $selectedId);
    if ($focusedAnnouncement) {
        $pageTitle = htmlspecialchars($focusedAnnouncement['title']);
    } else {
        // Redirect if the announcement is not found
        $redirectUrl = "announcements.php";
        if ($baseQueryString) {
            $redirectUrl .= "?" . $baseQueryString;
        }
        header("Location: " . $redirectUrl);
        exit;
    }
} else {
    // Otherwise, fetch a list of announcements
    $announcements = getAnnouncements($conn, $searchTerm, $filterTag);
    if (!empty($filterTag)) {
        $pageTitle = "Announcements tagged: '" . htmlspecialchars($filterTag) . "'";
    } elseif (!empty($searchTerm)) {
         $pageTitle = "Search results for: '" . htmlspecialchars($searchTerm) . "'";
    }
}

// Determine if there is content to display for the footer
$noContentForFooter = false;
if (!$focusedAnnouncement && empty($announcements)) {
    $noContentForFooter = true;
}

?>
<?php 
// Include the header file to start the HTML structure
include '_header.php'; 
?>
<main class="min-h-screen pt-24 px-4 sm:px-6 lg:px-8" style="background-color: #080c25;">
    <div class="max-w-7xl mx-auto py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-[#b9da05] mb-4">Announcements</h1>
            <?php if (!$focusedAnnouncement && (empty($searchTerm) && empty($filterTag))): ?>
                <p class="text-lg text-gray-400">Stay updated with the latest news and events from BulSU MSC</p>
            <?php elseif (!empty($searchTerm) && !$focusedAnnouncement): ?>
                <p class="text-lg text-gray-400">Showing results for "<?= htmlspecialchars($searchTerm) ?>"
                    <?= !empty($filterTag) ? " in tag '" . htmlspecialchars($filterTag) . "'" : "" ?>
                </p>
            <?php elseif (!empty($filterTag) && !$focusedAnnouncement): ?>
                 <p class="text-lg text-gray-400">Showing announcements tagged with "<?= htmlspecialchars($filterTag) ?>"</p>
            <?php endif; ?>
        </div>

        <?php if (!$focusedAnnouncement): ?>
        <div class="bg-[#011538] rounded-3xl p-6 mb-8 shadow-xl border border-[#b9da05]/20">
            <form method="get" action="announcements.php" class="flex flex-col sm:flex-row gap-4 items-stretch">
                <div class="flex-grow">
                    <div class="relative flex items-center">
                        <i class="fas fa-search absolute left-4 text-gray-400"></i>
                        <input type="text" name="search" class="w-full pl-12 pr-4 py-3 rounded-full bg-[#00071c] text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#b9da05] transition-all"
                             placeholder="Search announcements by keyword..."
                             value="<?= htmlspecialchars($searchTerm) ?>">
                    </div>
                </div>
                <?php if (!empty($filterTag)): ?>
                    <input type="hidden" name="tag" value="<?= htmlspecialchars($filterTag) ?>">
                <?php endif; ?>
                <div>
                    <button type="submit" class="w-full sm:w-auto bg-[#b9da05] text-[#00071c] font-bold py-3 px-6 rounded-full transition-all duration-300 hover:bg-white hover:text-[#00071c] shadow-md">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </form>

            <?php if (!empty($allTags)): ?>
            <div class="mt-6 text-center">
                 <div class="flex items-center justify-center flex-wrap mb-2">
                    <span class="text-sm font-semibold text-gray-400">Or filter by Tags:</span>
                    <?php 
                        $clearFilterQuery = [];
                        if (!empty($searchTerm)) $clearFilterQuery['search'] = $searchTerm;
                        $clearFilterLink = 'announcements.php' . (!empty($clearFilterQuery) ? '?' . http_build_query($clearFilterQuery) : '');
                        
                        $clearSearchQuery = [];
                        if(!empty($filterTag)) $clearSearchQuery['tag'] = $filterTag;
                        $clearSearchLink = 'announcements.php' . (!empty($clearSearchQuery) ? '?' . http_build_query($clearSearchQuery) : '');

                        $clearAllLink = 'announcements.php';
                    ?>
                    <?php if (!empty($filterTag) || !empty($searchTerm)): ?>
                        <a href="<?= $clearAllLink ?>" class="ml-2 text-red-400 hover:underline transition-colors"><i class="fas fa-times-circle"></i> Clear All</a>
                    <?php endif; ?>
                </div>
                <div class="flex flex-wrap justify-center gap-2 mt-2">
                    <?php foreach ($allTags as $tag_item): ?>
                        <?php
                            $tagLinkParams = ['tag' => $tag_item['name']];
                            if (!empty($searchTerm)) {
                                $tagLinkParams['search'] = $searchTerm;
                            }
                        ?>
                        <a href="announcements.php?<?= http_build_query($tagLinkParams) ?>"
                            class="px-4 py-2 text-sm font-medium rounded-full transition-all duration-300
                            <?= ($filterTag === $tag_item['name']) ? 'bg-[#b9da05] text-[#00071c] border border-[#b9da05]' : 'bg-[#00071c] text-[#d1d5db] hover:bg-[#b9da05] hover:text-[#00071c] border border-gray-700' ?>">
                           <?= htmlspecialchars($tag_item['name']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="announcement-content-area">
            <?php if ($focusedAnnouncement): ?>
            <div class="bg-[#011538] rounded-3xl p-6 sm:p-10 shadow-xl border border-[#b9da05]/20">
                <a href="announcements.php<?= $baseQueryString ? '?' . $baseQueryString : '' ?>" class="text-[#b9da05] hover:text-white transition-colors duration-300 font-semibold mb-4 inline-flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Announcements
                </a>
                <div class="mt-4">
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-4"><?= htmlspecialchars($focusedAnnouncement['title']) ?></h1>
                    <div class="text-gray-400 text-sm mb-4">
                        <i class="far fa-calendar-alt mr-2"></i>
                        <span>Posted on <?= htmlspecialchars(date('F d, Y \a\t g:i A', strtotime($focusedAnnouncement['created_at']))) ?></span>
                    </div>
                </div>

                <?php if (!empty($focusedAnnouncement['image_path'])): ?>
                    <?php 
                        $imageSrc = htmlspecialchars($focusedAnnouncement['image_path']);
                        if (!filter_var($imageSrc, FILTER_VALIDATE_URL)) {
                             // This is a placeholder for local file paths
                             $imageSrc = "https://placehold.co/1200x500/EFEFEF/AAAAAA?text=Image+Not+Available";
                        }
                    ?>
                    <img src="<?= $imageSrc ?>"
                         alt="<?= htmlspecialchars($focusedAnnouncement['title']) ?>" class="w-full rounded-2xl mb-6 object-cover"
                         style="max-height: 500px;"
                         onerror="this.onerror=null; this.src='https://placehold.co/1200x500/EFEFEF/AAAAAA?text=Image+Load+Error';">
                <?php endif; ?>

                <?php if (!empty($focusedAnnouncement['tags'])): ?>
                    <div class="mb-6">
                        <strong class="text-gray-400"><i class="fas fa-tags mr-2 text-[#b9da05]"></i> Tags:</strong>
                        <?php
                            $tags_array = explode(',', $focusedAnnouncement['tags']);
                            foreach ($tags_array as $tag_individual):
                                $trimmed_tag = trim($tag_individual);
                                $tagDetailLinkParams = ['tag' => $trimmed_tag];
                        ?>
                            <a href="announcements.php?<?= http_build_query($tagDetailLinkParams) ?>" class="inline-block px-3 py-1 text-sm bg-[#00071c] text-[#d1d5db] rounded-full mt-2 mr-2 transition-colors hover:bg-[#b9da05] hover:text-[#00071c]">
                                <?= htmlspecialchars($trimmed_tag) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="prose prose-invert max-w-none text-gray-300">
                    <?= nl2br(htmlspecialchars($focusedAnnouncement['content'])) ?>
                </div>
            </div>

            <?php elseif (!empty($announcements)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($announcements as $announcement): ?>
                    <a href="announcements.php?id=<?= $announcement['id'] ?><?= $baseQueryString ? '&' . $baseQueryString : '' ?>" class="announcement-card block bg-[#011538] rounded-2xl shadow-lg border border-[#b9da05]/20 hover:scale-[1.02] transition-transform duration-300">
                        <?php if (!empty($announcement['image_path'])): ?>
                            <div class="h-48 overflow-hidden rounded-t-2xl">
                                <?php
                                    $listItemImageSrc = htmlspecialchars($announcement['image_path']);
                                    if (!filter_var($listItemImageSrc, FILTER_VALIDATE_URL)) {
                                         $listItemImageSrc = "https://placehold.co/400x220/E9ECEF/6C757D?text=No+Image";
                                    }
                                ?>
                                <img src="<?= $listItemImageSrc ?>" class="w-full h-full object-cover" alt="<?= htmlspecialchars($announcement['title']) ?>"
                                     onerror="this.onerror=null; this.src='https://placehold.co/400x220/E9ECEF/6C757D?text=Error';">
                            </div>
                        <?php else: ?>
                            <div class="h-48 flex items-center justify-center bg-[#00071c] rounded-t-2xl">
                                <i class="fas fa-bullhorn text-5xl text-gray-600"></i>
                            </div>
                        <?php endif; ?>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-2"><?= htmlspecialchars($announcement['title']) ?></h3>
                            <div class="text-gray-400 text-sm mb-3">
                                <i class="far fa-calendar-alt mr-2"></i>
                                <span><?= htmlspecialchars(date('M d, Y', strtotime($announcement['created_at']))) ?></span>
                            </div>
                            <?php if (!empty($announcement['tags'])): ?>
                                <div class="flex flex-wrap gap-1 mb-4">
                                    <?php
                                        $tags_array = explode(',', $announcement['tags']);
                                        $tag_count = 0;
                                        foreach ($tags_array as $tag_individual):
                                            if ($tag_count < 3):
                                    ?>
                                        <span class="px-2 py-1 text-xs bg-[#b9da05]/20 text-[#b9da05] rounded-full"><?= htmlspecialchars(trim($tag_individual)) ?></span>
                                    <?php       $tag_count++;
                                            else:
                                                echo '<span class="px-2 py-1 text-xs bg-[#b9da05]/20 text-[#b9da05] rounded-full">...</span>';
                                                break;
                                            endif;
                                        endforeach;
                                    ?>
                                </div>
                            <?php endif; ?>
                            <p class="text-gray-300 text-sm leading-relaxed"><?= makeSnippet($announcement['content'], 100) ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="bg-[#011538] rounded-3xl p-12 text-center shadow-xl border border-[#b9da05]/20">
                <div class="text-gray-600 mb-6">
                    <i class="fas fa-bullhorn text-6xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-2">No Announcements Yet</h3>
                <?php if (!empty($searchTerm) || !empty($filterTag)): ?>
                    <p class="text-gray-400 mb-4">
                        We couldn't find any announcements matching your current filters or search term.
                        Try adjusting your search or <a href="announcements.php" class="text-[#b9da05] hover:underline">view all announcements</a>.
                    </p>
                <?php else: ?>
                    <p class="text-gray-400 mb-4">There are currently no announcements posted. Please check back soon for updates!</p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php 
// Include the footer file to close the HTML structure
include '_footer.php'; 

// Close the database connection
if ($conn) {
    $conn = null;
}
?>

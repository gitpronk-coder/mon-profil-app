<?php
// Content for project listing

// Assuming you have a method to fetch projects
$projects = fetchProjects();

if(empty($projects)) {
    echo '<p>No projects found.</p>';
} else {
    echo '<ul>';
    foreach($projects as $project) {
        echo '<li>' . htmlspecialchars($project['name']) . '</li>';
    }
    echo '</ul>';
}
?>
<?php
// skills.php

// Skills showcase

function showcaseSkills() {
    $skills = ['PHP', 'JavaScript', 'HTML', 'CSS', 'SQL'];
    echo '<h2>Skills Overview</h2>';
    echo '<ul>';
    foreach ($skills as $skill) {
        echo '<li>' . $skill . '</li>';
    }
    echo '</ul>';
}

showcaseSkills();
?>
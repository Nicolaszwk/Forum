<?php

$searchResults = $result['data']['searchResults'];

?>

<h1>Résultat de la recherche</h1>

<?php
if ($searchResults) {


        foreach ($searchResults as $searchResult) {
?>
                <div>
                        <?php
                        if ($searchResult->getCategoryName()) {
                        ?>
                                <a href="index.php?ctrl=forum&action=listTopics&id=<?= $searchResult->getId() ?>">
                                        <p><?= $searchResult->getCategoryName() ?></p>
                                </a>
        <?php
                        }
                }
        } else {
                echo "Il n'y a pas de résultat pour cette recherche";
        }
        ?>
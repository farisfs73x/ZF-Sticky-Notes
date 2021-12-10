<?php

/** @var Connection $connection */
$connection = require_once 'connection_notes.php';
// Read notes from database
$notes = $connection-> getNotes();

$currentNote = [
    'id' => '',
    'title' => '',
    'description' => ''
];
if (isset($_GET['id'])) {
    $currentNote = $connection->getNoteById($_GET['id']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Note</title>
    <link rel="stylesheet" href="index_note.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap">
</head>
<body class="main">
<div>

    <div class="wrapper">
        <div class="logo">
            <img src="Assets/logo1.png" alt="logo of zf" style="width:15%;height:15%;">
        </div>

        <ul class="nav-area">
            <li><a href="home.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact Us</a></li>
        </ul>
        <br><br><span style=" width: 100%; margin-left: 1px; color:#8f81f3;  opacity:0.9; font-family:'Marck Script',cursive;  font-size:50px;">STICKY</span>
        <span style=" width: 100%; margin-left: 500px; color:#8f81f3;  opacity:0.9; font-family:'Marck Script',cursive;  font-size:50px;">NOTES!</span>

    </div>
    <br/>
    <br/>
    <form class="new-note" action="create_note.php" method="post">

        <input type="hidden" name="id" value="<?php echo $currentNote['id'] ?>">
        <input type="text" name="title" placeholder="Note title" autocomplete="off"
               value="<?php echo $currentNote['title'] ?>">
        <textarea name="description" cols="30" rows="4"
                  placeholder="Note Description"><?php echo $currentNote['description'] ?></textarea>
        <button>
            <?php if ($currentNote['id']): ?>
                Update
            <?php else: ?>
                New note
            <?php endif ?>
        </button>
    </form>
    <div class="notes">
        <?php foreach ($notes as $note): ?>
            <div class="note">
                <div class="title">
                    <a href="?id=<?php echo $note['id'] ?>">
                        <?php echo $note['title'] ?>
                    </a>
                </div>
                <div class="description">
                    <?php echo $note['description'] ?>
                </div>
                <small>
                    <?php echo date('d/m/Y H:i', strtotime($note['create_date'])) ?></small>
                <form action="delete_note.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $note['id'] ?>">
                    <button class="close">X</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
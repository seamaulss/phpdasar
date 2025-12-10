<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
    <style>
        .kotak {
            width: 20px;
            height: 20px;
            background-color: #bada55;
            text-align: center;
            line-height: 20px;
            margin: 20px;
            float: left;
            transition: 1s;
        }
        .kotak:hover {
            transform: rotate(180deg);
            border-radius: 100%;
        }
    </style>
</head>
<body>
    
    <?php
        $angka = [
        [1,2,3], 
        [4,5,6],
        [9,8,9]
        ];
    ?>

    <?php foreach ( $angka as $a ) : ?>
        <?php foreach ( $a as $b ) : ?>
        <div class="kotak"><?=  $b; ?></div>
        <?php endforeach; ?>
        <div class="clear"></div>
    <?php endforeach; ?>
</body>
</html> 
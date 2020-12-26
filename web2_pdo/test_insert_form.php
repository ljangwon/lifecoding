<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title> test table insert form </title>
    </head>   
    <body>
        <form action="./test_process.php?mode=insert" method="POST">
            <p>시험제목 : <input type="text" name="title"></p>
            <p>시험설명 : <textarea name="description" id="" cols="30" rows="10"></textarea></p>
            <p><input type="submit" /></p>            
        </form>
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  

<?php

    interface IQuestion{
        public function ShowQuestion();
    }

    abstract class CQuestion{
        public $questions;
     

        public function __construct($questions){
            $this->questions = $questions;
        }

        abstract public function ShowQuestion();
        abstract  public function checkAnswer($question, $answer);
    }

    class CAnyAnswer extends CQuestion{

        public function ShowQuestion(){
            $index = array_rand($this->questions);
            return $index;
        }
           
        public function checkAnswer($idQuestion, $idAnswer){
            if($this->questions[$idQuestion]['CHECK'] == $idAnswer){
                return true;
            }else{
                return false;
            }
        }

    }

    $arQuestion = array(
        array(
            'QUESTION' => "Сколько типов данных в PHP?",
            'ANSWERS' => array(2, 4, 5, 6, 7, 8),
            "CHECK" => array(0, 5)
        ),
        array(
            'QUESTION' => "Как обьявляеться переменная в PHP?",
            'ANSWERS' => array('$var = 10;', 'int var = 10;', 'var v = 10;'),
            "CHECK" => array(0, 1)
        ),
        array(
            'QUESTION' => "Как обьявляется массив в PHP?",
            'ANSWERS' => array('$var = array();', 'int var = [];', '$var = [];'),
            "CHECK" => array(0, 2)
        ),
        array(
            'QUESTION' => "Как обьявляеться константа в PHP?",
            'ANSWERS' => array('$var = 10;', 'define("PI", 3.14);', 'var v = 10;'),
            "CHECK" => array(0, 1)
        )
    );
    
    $anyAnswer = new CAnyAnswer($arQuestion);
    
    if(!$_REQUEST['send'])
        $index = $anyAnswer->ShowQuestion();

    if($_REQUEST['send']){
        $index = $_REQUEST['question'];
        
    }

?>
    <form action="" method="post">
        <p><?php echo $arQuestion[$index]['QUESTION']?></p>
        <input type="hidden" name="question" value="<?php echo $index?>">
        <?php foreach($arQuestion[$index]['ANSWERS'] as $key => $question):?>
            <p>
               <input type="checkbox" name="answer<?php echo $key?>" id="answer<?php echo $key?>"
                      value="<?php echo $key?>"
                  <?php if($_REQUEST["answer". "$key"] != ''):?>
                     checked
                     <?php $arAnswer[] = $_REQUEST["answer". "$key"]?>
                  <?php endif; ?>>
               <label for="answer<?php echo $key?>"><?php echo $question?></label>
            </p>
        <?php endforeach?>
        <input type="submit" class="btn btn-primary" name="send" value="Проверить">
        <a href="task101.php" class="btn btn-default">Следующий вопрос</a>
    </form>

<?php
if(!$anyAnswer->checkAnswer($_REQUEST['question'], $arAnswer)){
            echo "<p>Ответ не верный!</p>";
        }
?>

</body>
</html>




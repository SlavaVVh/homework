
<?php
  
  class CCurrency{
    protected $name;
    protected $currency;

    public function __construct($currency, $name)
    {
       $this->name = $name;
       $this->currency = $currency;
    }
    protected function getRate()
    {
      return $this->currency. " - ". $this->name. " - ";
    }
    
  }

  class CName extends CCurrency{
    protected $rate;

    public function __construct($currency, $name, $rate)
    {
       parent::__construct($currency, $name);
       $this->rate = $rate;
    }
     
    public function getRate()
    {
       return parent::getRate(). $this->rate;
    }
  }
      
$arCurrency = array(
  array('USD', 'Доллар США', 23.48),
  array('EUR', 'Евро', 25.46),
  array('RUB', 'Российский рубль', 0.332)
 );
?>
<p>Курс валют НБУ</p>
<?php
$size = count($arCurrency);
for($i=0; $i < $size; $i++)
{
  $rate = new CName($arCurrency[$i][0], $arCurrency[$i][1], $arCurrency[$i][2]);
  echo $rate->getRate(), "<br>";
}


?>









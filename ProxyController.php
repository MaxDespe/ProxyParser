<?php  namespace ProxyManager;


use ProxyManager\Controllers\SearcherControllers;
use ProxyManager\Controllers\CheckerControllers;
use ProxyManager\Controllers\SettingControlles;
use ProxyManager\Controllers\ListFileControllers;
use ProxyManager\Controllers\InputCheckControllers;
use ProxyManager\Controllers\SearchParametrs\ApiParametrs;
use ProxyManager\Controllers\SearchParametrs\ParserParametrs;
use ProxyManager\ProxySearcher\ApiProxySeacher;
use ProxyManager\ProxySearcher\ProxySearcher;
use ProxyManager\ProxyManager;

class ProxyController
{
	public $SearcherControllers;
	public $FileNameSearchers;
	public $FileNameValid;
	
	public $ChekersConfig = [
		'timeout'   => 10,
		'check'     => ['get', 'post', 'cookie', 'referer', 'user_agent'],
	];
	
	/**
	* @return array
	*/
	public function __construct(array $MetothodSearchConfig = array()){
		$this->SearcherControllers = new SearcherControllers($MetothodSearchConfig);	
		SettingControlles::initDIRHoume($this->setDIRHoumeModule());
		SettingControlles::initChekersConfig($this->ChekersConfig);
		ProxyManager::initLoadProxyValid();
    } 

	
	/**
	* @return string
	*/
    public function setCheckFilesSearchers(){
	
		$this->FileNameSearchers = SettingControlles::getFileNameSearchers();
		$this->FileNameValid = SettingControlles::getFileNameValid();
		
		if(! $this->setLoadFileName(SettingControlles::getDIRHoumeLogData(), $this->FileNameSearchers)){
			$DataFile->setDeleteMyfile();
			echo "Файл пуст/удален. Совершаем новый поиск <br />";
			$this->setProxySearcher();
		}		
		echo "Файл еще имеет данные <br />";
		if($this->setEditFileTime(SettingControlles::getDIRHoumeLogData(), $this->FileNameSearchers)){
			echo "Время с момента парсинга прокси привышает 1 час <br />";
			$this->setProxySearcher();
		}
		return true;
	}
	
	
	/**
	* @return string
	*/
    public function setProxySearcher(){
		return $this->SearcherControllers->getList();
	}
	

	/**
	* @return string
	*/
    public function setDIRHoumeModule(){
		return $parent_dir = __DIR__;
	}
	
	/**
	* @return string
	*/
    public function setLoadFileName($Dirname, $FileName){
		$DataFile = new ListFileControllers($Dirname);
		$DataFile->setNameFile($FileName);
		if($DataFile->setFileExists()){
			if(! $DataFile->getSizeFile() == 0){	
				return true;
			}
			if(count($DataFile->getFileArray()) > 2){	
				return true;
			}
		}
		return false;
	}
	
	/**
	* @return string
	*/
    public function setEditFileTime($Dirname, $FileName){
		$DataFile = new ListFileControllers($Dirname);
		$DataFile->setNameFile($FileName);
		$EditTimeContentFile = $DataFile->setTimeContentFile();
		$HourseLatter = (time() - 3600);
		echo  'Время последнего редактирования контента ' . $DataEditTimeContentFile  = date("Y-m-d H:i:s", $EditTimeContentFile);
		echo "<br />";
		echo  'Временная метка - 1 час ' .$DataHourseLatter  = date("Y-m-d H:i:s", $HourseLatter);
		echo "<br />";
		
		if($DataFile->setTimeContentFile() < $HourseLatter){
			return true;
		}else{
			return false; 
		}
	}
	
	
	/**
	* @return string
	*/
    public function setProcesChekers(){
		$Check =  new CheckerControllers();
		$this->Check = $Check;
		$Request = $Check->getChckArr($this->ChekersConfig); 
	}
	
	/**
	*
    */
	public function InputDataForms(){
		?>
		<form role="form" name="HistoryPayment" method="POST" action=" "> 
		<div class="form"><label for="start">Выбрать период показа</label>
		<div class="field2"><label for="start">Начало</label><input type="text" id="start" name="start"></div>
		<div class="field2"><label for="end">Конец</label><input type="text" id="end" name="end"></div>
		<div class="field2"><label for="operation">Вид операций</label><select name="SelectionOperation" size="1">
		<?php
			$Operations = array(
				"ALL"=>"ALL", 
				"IN"=>"IN", 
				"OUT"=>"OUT", 
				"QIWI_CARD"=>"QIWI_CARD" 
			);
			foreach ($Operations as $value) 
			{ 
				?><option value="<?=$value?>"><?=$value?></option><?php
			}
			?>
		</select></div>
		
		<div class="field2"><label for="sources">Счет операций</label><select name="SelectionSources" size="1">
			<?php 
			$Sources = array(
				"QW_RUB"=>"рублевый счет кошелька,", 
				"QW_USD "=>"счет кошелька в долларах", 
				"QW_EUR "=>"счет кошелька в евро", 
				"CARD "=>" банковские карты",
				"MK  "=>"счет мобильного оператора" 
			);
			foreach ($Sources as $Sourc) 
			{ 
				?><option value="<?=$Sourc?>"><?=$Sourc?></option><?php
			}
			?>
		</select></div>
		
		<div class="field2"><label for="rows">Число операций</label>
		<input type="text" id="rows" name="rows"></div>
		<div class="field"><input type="submit" name="HistoryPayment" value="Отправить"></div>
		</div>
		</form>
		<?php
	}
}
?>
<?php
class help{
	/**
	 * 
	 * contribute for message/index->审核状态
	 * @param unknown_type $data
	 */
	public function aa($data){
		
		
		switch($data){
			
			case 0 : $result='未审核';
			break;
			case 1 : $result='审核中...';
			break;
			case 2 : $result='已审核';
			break;
			case 3 : $result='<font color="red">审核未通过</font>';
			break;
			case 4 : $result='已回复';
			break;
			case 5 : $result='已阅读';
			break;
			
		
		}
		return $result;
		
	}
	
	/**
	 * 切割字符串时判断字符串长度是否符合某个长度，符合不切割，不符合切割
	 */
	
	public function subString($data){
		
		
		if(strlen($data)>40){
			
			
			
			$result = iconv_substr($data,0,10,"UTF-8")."...";	
			
		
		}else{
			
			
			$result = $data;
			
			
		}
		return $result;
		
	}
	
	/**
	 * 给URL传参
	 */
	public function urlHelper($url,$paramName,$paramValue){
		
		
		return Yii::app()->controller->createUrl($url."&".$paramName."=".$paramValue);
		
		
		
	}
	
	
}








?>
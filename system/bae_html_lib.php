<?php
/*
 *  HTMLLib 
 *  Автор: Бессонов Александр
 *  URL: http://bessonov.in.ua
 *  версия: 0.4
 * 
 */
class BAEHTMLLib{   
    public function make_baef_link($name,$controller,$method,$param=0,$attrib=""){
    	return "<a href='/?mode=$controller&method=$method&param=$param'>$name</a>";
    }
    
    public function makeTableSort($html){
        $html = str_replace("<table ","<table class='tablesorter' id='sort_table' onclick='jQuery(\"#sort_table\").tablesorter();' ",$html);
	return $html;
    }
    public function tbodyOpen(){
	return "<tbody>";
    }
    public function tbodyClose(){
	return "</tbody>";
    }
    public function theadOpen(){
	return "<thead>";
    }
    public function theadClose(){
	return "</thead>";
    }
    public function textarea($text,$attrib){
        return "<textarea ".$attrib.">".$text."</textarea>\n";
    }
    public function formOpen($attrib = ""){
        return "<form $attrib>\n";
    }
    public function formClose(){
        return "</form>\n";
    }
    public function divOpen($attrib = ""){
        return "<div $attrib> \n";
    }
    public function tableOpen($attrib = ""){
        return "<table $attrib>\n";
    }
    public function htmlAppend($html){
        return $html;
    }
    public function divWrapped($text_data="empty",$wrap_attrib=""){
        return "<div ".$wrap_attrib.">".$text_data."</div>";
    }
    public function theadWrapped($html,$attrib=""){
        return "<thead ".$attrib.">".$html."</thead>";
    }
    public function tableCreate($cols = 1, $data = array(),$table_attrib="", $td_attrib="",$make_th=false){
        $out = "<table $table_attrib>";
        $j = 0;
        $x = 0;
        if($make_th == true){
	    $out .= "<thead>";	
            $out .= "<tr>";
            for($i = 0; $i<$cols; $i++){
                $out .= "<th>".$data[$i]."</th>";
                
            }
            $x = $cols;
            $out .= "</tr>";
	    $out .= "</thead>";
        }
	$out .= "<tbody>";
        for($i = $x; sizeof($data) > $i; $i++){
            if($j==0) $out .="<tr>\n";
            $j++;
            $out .= "<td $td_attrib>$data[$i]</td>\n";
            if($j==$cols) {$out .="</tr>\n"; $j=0;};
        }
        $out .= "</tbody></table> \n";
        return $out;
    }
    
    public function trWrapped($text = "",$tr_attrib=""){
        $out = "<tr ".$tr_attrib.">\n".$text."\n</tr>\n";
        return $out;
    }
    
    public function td($text = "", $td_attrib=""){
        $out = "<td ".$td_attrib.">\n".$text."\n</td>\n";
        return $out;
    }
    
    public function th($text = "", $th_attrib=""){
        $out = "<th ".$th_attrib.">\n".$text."\n</th>\n";
        return $out;
    }
    
    public function trAdd($cols = 1, $data = array(), $td_attrib=""){
        $j = 0;
        for($i = 0; sizeof($data) > $i; $i++){
            if($j==0) $out .="<tr>\n";
            $j++;
            $out .= "<td $td_attrib>$data[$i]</td>\n";
            if($j==$cols) {$out .="</tr>\n"; $j=0;};
        }
        return $out;
    }
    public function img($attrib){
        return "<img $attrib> \n";
    }
    public function tableClose(){
        return "</table>\n";
    }
    public function javaScriptLink($src){
        return "<script type='text/javascript' src='".$src."'></script> \n";
    }
    public function javaScriptOpen(){
        return "<script type='text/javascript'> \n";
    }
    public function javaScriptClose(){
        return "</script> \n";
    }
    public function divInnerHTML($inner = "", $attrib = ""){
        return "<div ".$attrib.">".$inner."</div> \n";
    }
    
    public function divClose(){
        return "</div> \n";
    }
    
    public function span($text = "", $attrib = ""){
       return "<span ".$attrib.">".$text."</span>"; 
    }
    
    public function htmlOpen($type="5",$language="ru"){
        $out = "<html>";
        if($type == "5"){
            $out = "<!DOCTYPE html>";
            $out .= "<html lang='".$language."'>";
            return $out."\n";
        }
        return $out."\n";
    }
    public function headOpen(){
        return "<head>"."\n";
    }
    public function meta($attrib = "http-equiv='content-type' content='text/html; charset=utf8;'"){
        return "<meta $attrib />"."\n";
    }
    public function link($attrib){
        return "<link $attrib>"."\n";
    }
    public function headClose(){
        return "</head>"."\n";
    }
    
    
    public function a($atext="link", $attrib=""){
        return "<a $attrib>$atext</a>"."\n";
    }
    
    public function br($attrib=""){
        return"<br $attrib>"."\n";
    }
    
    public function b($text="link", $attrib=""){
        return "<b $attrib>$text</b>"."\n";
    }
    
    public function hr($attrib=""){
        return"<hr $attrib>"."\n";
    }
    public function select($attrib,array $values){
        $out = "";
        $out = "<select $attrib>";
        for($i = 0; $i < sizeof($values); $i+=2){
            $out .= "<option value='".$values[$i]."'>".$values[$i+1]."</option>\n";
        }
        $out .= "</select>";
        return $out."\n";
    }
    public function input($attrib){
        return "<input $attrib>"."\n";
    }
    
    public function wrapped($tag="b",$data="",$attrib=""){
        return "<".$tag." ".$attrib.">".$data."</".$tag."> \n";
    }
    public function scriptWrapped($data){
        return "<script type='text/javascript'>\n ".$data." </script>\n";
    }
    public function bodyOpen($attrib =""){
        return "<body ".$attrib.">\n";
    }
    public function bodyClose(){
        return "</body>\n";
    }
    public function htmlClose(){
        return "</html> \n";
    }
    public function javaScriptWrapped($script_text){
        return "<script type='text/javascript'> \n".$script_text." \n</script>\n";
    }
    
    
    
}

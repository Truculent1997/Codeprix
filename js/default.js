var currenttheme="default";
var theme=localStorage.getItem("currenttheme");
var curcom="c";
var com=localStorage.getItem("curcom");
var code = $(".codemirror-textarea")[0];
var editor = CodeMirror.fromTextArea(code, {
	"lineNumbers": true,
	"styleActiveLine": true,
	"autoCloseBrackets": true,
	"extraKeys" :{ "Alt-F":"findpersistent"},
	"mode":"text/x-csrc"
});
function savedata(){
localStorage.setItem("currenttheme",theme);
}
/*
window.onload = function() {

}
*/
function selectTheme(){

var input=document.getElementById("select");

theme=input.options[input.selectedIndex].textContent;
editor.setOption("theme",theme);
localStorage.setItem("currenttheme",theme);
}
/*
function showCode(){
var text=editor.mirror.getValue();
document.getElementById("compiler").innerHTML = text;
}*/
/*
var input=document.getElementById("select");
var input2=document.getElementById("compiler");
var ca="text/x-c++src";
var ca1="text/x-java";
var ca2="text/x-csrc";
function selectCompiler(){

com=input2.options[input2.selectedIndex].textContent;
//alert(com);
if(com.localeCompare("C++")==0)
{
		editor.setOption("mode",ca);
}
else if(!com.localeCompare("C"))
{
		editor.setOption("mode",ca2);
}
else
{		//alert("Hello2"+com);
		editor.setOption("mode",ca1);
}
}
*/

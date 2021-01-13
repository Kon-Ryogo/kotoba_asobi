var kotoba=document.getElementById('kotoba');
console.log(kotoba);
var kotoba_text=kotoba.textContent;
let kotoba_array=kotoba_text.split('');
var count=0;
var bool_list=[];
var bool_list2=[];

//初期化
for(var i=0;kotoba_array[i]!=null;i++)
{
    console.log(kotoba_array[i]);
    bool_list[i]=false;
    bool_list2[i]=false;
    count++;
}

//回答ボタンシステム
window.onload=function(){
    const strList=kotoba_array;
    var boolList=bool_list;
    var indexList=[];
    
    for(var i=0;i<count;){
        var num =Math.floor(Math.random()*count); 
        
        if(!boolList[num]){
            indexList.push(strList[num]);
            boolList[num]=true;
            i++;
        }
    }

    for(var k=0;k<count;k++){
        var a=k+1;
        var element=document.getElementById('kaito'+a);
        element.textContent=indexList[k];
    }
}

//アンサーボックスブールシステム
function getIdNum(){
    for(var i=0;i<count;i++){
        if(bool_list2[i]===false) {
            bool_list2[i]=true;
            var val=i+1;
            break;
        }
    }
    return val;
}

//アンサーボックスへ回答を挿入
function getId(element){
    var kaito=document.getElementById(element.id);
    var str1=kaito.textContent;
    var ansNum=getIdNum();
    var ans=document.getElementById('ans'+ansNum);
    ans.textContent=str1;
}

//やりなおす
function reset() {
    for(var i=0;i<count;i++)
    {
        var ans=document.getElementById('ans'+(i+1));      
        ans.textContent='？';
        bool_list2[i]=false;
    }
}

//けってい！
function moveAns() {
    var Answer=kotoba_array;
    var answer=[count];
    for(var i=0;i<count;i++)
    {
        var ans=document.getElementById('ans'+(i+1));
        var a=ans.textContent;
        answer[i]=a;
    }
    var ans_count=0;
    for(var k=0;k<count;k++)
    {
        if(Answer[k]===answer[k]){
            ans_count++;
        }
    }

    if(ans_count==count)
    {
        // 正解画面の表示
        var maru = document.getElementById("maru").style.display ="block";
        var rma = document.getElementById("rma").style.display ="none";
        sound_seikai();
    }
    else
    {
        // はずれ画面の表示
        var batsu = document.getElementById("batsu").style.display ="block";
        var rma = document.getElementById("rma").style.display ="none";
        sound_huseikai();
    }
}

//↓サウンド
//ボタンSE
function sound_push()
{
	var id = 'push' ;

	if( typeof( document.getElementById( id ).currentTime ) != 'undefined' )
	{
		document.getElementById( id ).currentTime = 0;
	}
	document.getElementById( id ).play() ;
}

//正解SE
function sound_seikai()
{
	var id = 'seikai' ;

	if( typeof( document.getElementById( id ).currentTime ) != 'undefined' )
	{
		document.getElementById( id ).currentTime = 0;
	}

	document.getElementById( id ).play() ;
}

//不正解SE
function sound_huseikai()
{
	var id = 'huseikai' ;

	if( typeof( document.getElementById( id ).currentTime ) != 'undefined' )
	{
		document.getElementById( id ).currentTime = 0;
	}

	document.getElementById( id ).play() ;
}

//遷移
function href_sound(pass) {
    var startMsec = new Date();
   
    while (new Date() - startMsec <180);
    window.location.href = pass;
}

//遅延(ipadでのサウンド対応)
function sound_chien() {
    var startMsec = new Date();
    while (new Date() - startMsec <180);
}
  



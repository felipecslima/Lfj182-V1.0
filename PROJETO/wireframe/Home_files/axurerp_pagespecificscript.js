
var PageName = 'Home';
var PageId = '7219fd95d287491e96aa74b3209c49ef'
var PageUrl = 'Home.html'
document.title = 'Home';
var PageNotes = 
{
"pageName":"Home",
"showNotesNames":"False"}
var $OnLoadVariable = '';

var $CSUM;

var hasQuery = false;
var query = window.location.hash.substring(1);
if (query.length > 0) hasQuery = true;
var vars = query.split("&");
for (var i = 0; i < vars.length; i++) {
    var pair = vars[i].split("=");
    if (pair[0].length > 0) eval("$" + pair[0] + " = decodeURIComponent(pair[1]);");
} 

if (hasQuery && $CSUM != 1) {
alert('Prototype Warning: The variable values were too long to pass to this page.\nIf you are using IE, using Firefox will support more data.');
}

function GetQuerystring() {
    return '#OnLoadVariable=' + encodeURIComponent($OnLoadVariable) + '&CSUM=1';
}

function PopulateVariables(value) {
    var d = new Date();
  value = value.replace(/\[\[OnLoadVariable\]\]/g, $OnLoadVariable);
  value = value.replace(/\[\[PageName\]\]/g, PageName);
  value = value.replace(/\[\[GenDay\]\]/g, '15');
  value = value.replace(/\[\[GenMonth\]\]/g, '8');
  value = value.replace(/\[\[GenMonthName\]\]/g, 'agosto');
  value = value.replace(/\[\[GenDayOfWeek\]\]/g, 'segunda-feira');
  value = value.replace(/\[\[GenYear\]\]/g, '2011');
  value = value.replace(/\[\[Day\]\]/g, d.getDate());
  value = value.replace(/\[\[Month\]\]/g, d.getMonth() + 1);
  value = value.replace(/\[\[MonthName\]\]/g, GetMonthString(d.getMonth()));
  value = value.replace(/\[\[DayOfWeek\]\]/g, GetDayString(d.getDay()));
  value = value.replace(/\[\[Year\]\]/g, d.getFullYear());
  return value;
}

function OnLoad(e) {

}

var u31 = document.getElementById('u31');

var u36 = document.getElementById('u36');
gv_vAlignTable['u36'] = 'top';
var u59 = document.getElementById('u59');

var u16 = document.getElementById('u16');

var u17 = document.getElementById('u17');
gv_vAlignTable['u17'] = 'top';
var u28 = document.getElementById('u28');

var u29 = document.getElementById('u29');

var u8 = document.getElementById('u8');

var u30 = document.getElementById('u30');

var u6 = document.getElementById('u6');
gv_vAlignTable['u6'] = 'top';
var u58 = document.getElementById('u58');

var u32 = document.getElementById('u32');

var u38 = document.getElementById('u38');
gv_vAlignTable['u38'] = 'top';
var u40 = document.getElementById('u40');
gv_vAlignTable['u40'] = 'top';
var u60 = document.getElementById('u60');
gv_vAlignTable['u60'] = 'center';
var u13 = document.getElementById('u13');
gv_vAlignTable['u13'] = 'top';
var u14 = document.getElementById('u14');

var u15 = document.getElementById('u15');
gv_vAlignTable['u15'] = 'top';
var u56 = document.getElementById('u56');
gv_vAlignTable['u56'] = 'top';
var u43 = document.getElementById('u43');

var u44 = document.getElementById('u44');
gv_vAlignTable['u44'] = 'top';
var u57 = document.getElementById('u57');

var u1 = document.getElementById('u1');
gv_vAlignTable['u1'] = 'center';
var u37 = document.getElementById('u37');

u37.style.cursor = 'pointer';
if (bIE) u37.attachEvent("onclick", Clicku37);
else u37.addEventListener("click", Clicku37, true);
function Clicku37(e)
{
windowEvent = e;


if (true) {

	self.location.href="A_Empresa.html" + GetQuerystring();

}

}

var u26 = document.getElementById('u26');

u26.style.cursor = 'pointer';
if (bIE) u26.attachEvent("onclick", Clicku26);
else u26.addEventListener("click", Clicku26, true);
function Clicku26(e)
{
windowEvent = e;


if (true) {

	self.location.href="Contato.html" + GetQuerystring();

}

}

var u41 = document.getElementById('u41');

var u10 = document.getElementById('u10');

u10.style.cursor = 'pointer';
if (bIE) u10.attachEvent("onclick", Clicku10);
else u10.addEventListener("click", Clicku10, true);
function Clicku10(e)
{
windowEvent = e;


if (true) {

	self.location.href="resources/reload.html#" + encodeURI(PageUrl + GetQuerystring());

}

}

var u11 = document.getElementById('u11');
gv_vAlignTable['u11'] = 'top';
var u3 = document.getElementById('u3');
gv_vAlignTable['u3'] = 'center';
var u12 = document.getElementById('u12');

u12.style.cursor = 'pointer';
if (bIE) u12.attachEvent("onclick", Clicku12);
else u12.addEventListener("click", Clicku12, true);
function Clicku12(e)
{
windowEvent = e;


if (true) {

	self.location.href="A_Empresa.html" + GetQuerystring();

}

}

var u39 = document.getElementById('u39');

var u9 = document.getElementById('u9');

var u35 = document.getElementById('u35');

u35.style.cursor = 'pointer';
if (bIE) u35.attachEvent("onclick", Clicku35);
else u35.addEventListener("click", Clicku35, true);
function Clicku35(e)
{
windowEvent = e;


if (true) {

	self.location.href="resources/reload.html#" + encodeURI(PageUrl + GetQuerystring());

}

}

var u27 = document.getElementById('u27');
gv_vAlignTable['u27'] = 'top';
var u7 = document.getElementById('u7');

var u42 = document.getElementById('u42');
gv_vAlignTable['u42'] = 'top';
var u61 = document.getElementById('u61');
gv_vAlignTable['u61'] = 'top';
var u23 = document.getElementById('u23');
gv_vAlignTable['u23'] = 'top';
var u24 = document.getElementById('u24');

var u4 = document.getElementById('u4');
gv_vAlignTable['u4'] = 'top';
var u46 = document.getElementById('u46');
gv_vAlignTable['u46'] = 'top';
var u53 = document.getElementById('u53');

var u54 = document.getElementById('u54');
gv_vAlignTable['u54'] = 'top';
var u5 = document.getElementById('u5');
gv_vAlignTable['u5'] = 'top';
var u2 = document.getElementById('u2');

var u18 = document.getElementById('u18');

var u62 = document.getElementById('u62');

var u19 = document.getElementById('u19');
gv_vAlignTable['u19'] = 'top';
var u55 = document.getElementById('u55');

u55.style.cursor = 'pointer';
if (bIE) u55.attachEvent("onclick", Clicku55);
else u55.addEventListener("click", Clicku55, true);
function Clicku55(e)
{
windowEvent = e;


if (true) {

	self.location.href="Contato.html" + GetQuerystring();

}

}

var u20 = document.getElementById('u20');

var u21 = document.getElementById('u21');
gv_vAlignTable['u21'] = 'top';
var u48 = document.getElementById('u48');
gv_vAlignTable['u48'] = 'top';
var u22 = document.getElementById('u22');

var u49 = document.getElementById('u49');

var u47 = document.getElementById('u47');

var u50 = document.getElementById('u50');
gv_vAlignTable['u50'] = 'top';
var u25 = document.getElementById('u25');
gv_vAlignTable['u25'] = 'top';
var u51 = document.getElementById('u51');

var u45 = document.getElementById('u45');

var u52 = document.getElementById('u52');
gv_vAlignTable['u52'] = 'top';
var u33 = document.getElementById('u33');

var u34 = document.getElementById('u34');

var u0 = document.getElementById('u0');

if (window.OnLoad) OnLoad();

//ค่า ID ของ div ที่บรรจุรูปภาพขนาดจริง ซึ่งเราจะกำหนดให้ไม่ซ้ำกันสำหรับแต่ละภาพ
var id = 0;
//ค่า z-index สุดท้ายที่เพิ่งใช้ไป; เมื่อผู้ใช้คลิก Thumbnail เพื่อแสดงภาพขนาดจริง เราจะกำหนดค่า z-index ของ div ที่บรรจุภาพให้เท่ากับค่าในตัวแปรนี้บวก 1 เพื่อแสดงภาพออกมาข้างหน้าสุด นอกจากนี้หากแสดงภาพขนาดจริงมากกว่า 1 ภาพพร้อมกัน ผู้ใช้สามารถคลิกภาพที่ถูกบังเพื่อให้แสดงออกมาข้างหน้าสุดได้ ซึ่งเราทำโดยเปลี่ยนค่า z-index ของ div ที่บรรจุภาพนั้นให้เท่ากับค่าในตัวแปรนี้บวก 1 เช่นกัน (ดูฟังก์ชั่น onClickImage ซึ่งผูกกับอีเวนต์ onclick ของภาพ)
var lastZIndex = 0;

//ฟังก์ชั่นที่ใช้แสดงรูปภาพขนาดจริงออกมา
function getFullSizeImage(a,newsid) {
  //สร้างอิลิเมนต์ div สำหรับบรรจุรูปภาพขนาดจริง
  var containerDiv = document.createElement("div");
  containerDiv.style.zIndex = lastZIndex++;
  containerDiv.style.position = "absolute";
  //ขอบสีดำรอบรูปมาจากการกำหนด padding และ background ของ div นี้
  containerDiv.style.padding = "10px";
  containerDiv.style.background = "black";
  //ซ่อน div ไว้ก่อน เมื่อโหลดรูปภาพขนาดจริงเสร็จแล้วค่อยแสดงออกมา
  containerDiv.style.visibility = "hidden";

  document.body.appendChild(containerDiv);  //เพิ่ม div เข้าไปในเพจ

  containerDiv.id = "id" + id++;
  //ทำให้ div นี้เป็นอิลิเมนต์ที่คลิกลากได้ (ใช้ความสามารถของเฟรมเวิร์ค script.aculo.us)
  new Draggable(containerDiv.id, { revert: false, starteffect: false, endeffect: false });

  //สร้างอิลิเมนต์ img สำหรับแสดงรูปภาพขนาดจริง แต่บราวเซอร์จะเริ่มโหลดรูปภาพขนาดจริงเมื่อกำหนด src
  var image = document.createElement("img");
  //ข้อความใน alt จะแสดงออกมาเมื่อชี้เมาส์ที่ภาพ (สำหรับ IE)
  image.alt = "คลิกลากเพื่อเคลื่อนย้าย, ดับเบิลคลิกเพื่อปิดรูปภาพ";
  //ข้อความใน title จะแสดงออกมาเมื่อชี้เมาส์ที่ภาพ (สำหรับ Firefox)
  image.title = "คลิกลากเพื่อเคลื่อนย้าย, ดับเบิลคลิกเพื่อปิดรูปภาพ";
  //เมื่อโหลดรูปภาพเสร็จสมบูรณ์ ให้เรียกฟังก์ชั่น onLoadImageComplete (ทำหน้าที่เสมือนเป็น Callback Function ของการโหลดรูปภาพ)
  image.onload = onLoadImageComplete;
  //เมื่อคลิกรูปภาพ ให้เรียกฟังก์ชั่น onClickImage
  image.onclick = onClickImage;
  //เมื่อดับเบิลคลิกรูปภาพ ให้เรียกฟังก์ชั่น onDoubleClickImage
  image.ondblclick = onDoubleClickImage;

  //ใส่รูปภาพเข้าไปใน div
  containerDiv.appendChild(image);

  //สร้างอิลิเมนต์ div สำหรับแสดงข้อมูลเกี่ยวกับภาพ
  var infoDiv = document.createElement("div");
  infoDiv.style.marginTop = "10px";
  infoDiv.style.font = "10pt Tahoma";
  infoDiv.style.padding = "3px";
  infoDiv.style.background = "white";

  //ใส่ infoDiv เข้าไปใน containerDiv ซึ่งจะทำให้ infoDiv ถูกแสดงข้างล่างภาพ
  containerDiv.appendChild(infoDiv);

  //ใช้ AJAX เรียกไปยังเพจ image_info.php เพื่อขอข้อมูลเกี่ยวกับภาพ
  getDataReturnText("func/news_info.php?file=" + a.href + "&newsid=" +newsid+ "&id="+Math.random(), getImageInfoCallback);

  //กำหนด src ของรูปภาพเพื่อให้บราวเซอร์เริ่มโหลดรูปภาพ ซึ่งจะเป็นการโหลดแบบหลังฉากโดยที่ไม่ต้องใช้ AJAX
  image.src = a.href;

  //ส่งคืนค่า false กลับออกไปจากฟังก์ชั่น  เพื่อไม่ให้ไฮเปอร์ลิงค์ที่ครอบ Thumbnail ลิงค์ไปยัง href ที่ระบุ
  return false;  

  //Callback Function ของการใช้ AJAX ขอข้อมูลเกี่ยวกับภาพ โปรดสังเกตว่าฟังก์ชั่นนี้เป็น Inner Function ของฟังก์ชั่น getFullSizeImage เนื่องจากเราต้องการเข้าถึง infoDiv
  function getImageInfoCallback(data) {
    infoDiv.innerHTML = data;
  }
}

//ฟังก์ชั่นที่จะทำงานเมื่อบราวเซอร์โหลดรูปภาพขนาดจริงเรียบร้อยแล้ว การทำงานคือ จะแสดงภาพออกมาที่กึ่งกลางของหน้าจอบราวเซอร์ โดยให้ภาพค่อยๆชัดขึ้น (fade in)
function onLoadImageComplete() {
  //เนื่องจากฟังก์ชั่นนี้ผูกกับอีเวนต์ onload ของรูปภาพ ดังนั้น this จึงหมายถึงรูปภาพนั้นๆ
  var img = this;
  //this.parentNode จะหมายถึง div ที่บรรจุภาพขนาดจริงไว้
  var div = this.parentNode;
  var opacity = 0;  //เก็บค่าความชัดเจนที่กำหนดให้กับภาพ
  
  setOpacity(opacity);  //เริ่มต้นจะกำหนดความชัดเจนของภาพเป็น 0
  centerInBrowser();    //จัดภาพให้อยู่กึ่งกลางหน้าจอบราวเซอร์
  div.style.visibility = "visible";  //แสดง div ที่บรรจุรูปภาพออกมา
  //ทำให้ภาพค่อยๆชัดขึ้น โดยเรียกฟังก์ชั่น fadeIn ทุกๆ 100 มิลลิวินาที (0.1 วินาที)
  var timer = setInterval(fadeIn, 100);

  //ฟังก์ชั่นที่ใช้กำหนดความชัดเจนของภาพ (เป็น Inner Function เพราะต้องการเข้าถึงตัวแปร img)
  function setOpacity(opacity) {
    //ถ้าระบุค่าความชัดเจนมามากกว่า 100 ให้เปลี่ยนเป็น 100
    if (opacity > 100) { opacity = 100; }

    //บรรทัดนี้สำหรับ Internet Explorer
    img.style.filter = "alpha(opacity: " + opacity + ")";
    //บรรทัดนี้สำหรับ Mozilla และ Firefox เวอร์ชั่นเก่า
    img.style.MozOpacity = opacity / 100;
    //บรรทัดนี้สำหรับ Firefox และ Mozilla เวอร์ชั่นใหม่, Safari 1.2 และบราวเซอร์ที่สนับสนุนมาตรฐาน CSS3
    img.style.opacity = opacity / 50;
  }

  //ฟังก์ชั่นที่จะถูกเรียกซ้ำๆให้เพิ่มความชัดเจนของภาพขึ้นทีละน้อย และจะยกเลิกเมื่อค่าความชัดเจนมากกว่าหรือเท่ากับ 100 (เป็น Inner Function เพราะต้องการเข้าถึงตัวแปร timer)
  function fadeIn() {
    setOpacity(opacity);

    if (opacity < 100) { 
      opacity += 10;
    }
    else {
      clearInterval(timer);  //ยกเลิกการตั้งเวลาให้ทำซ้ำๆของฟังก์ชั่น setInterval
    }
  }

  //ฟังก์ชั่นที่ใช้จัดภาพให้อยู่กึ่งกลางพื้นที่แสดงผลของบราวเซอร์ (เป็น Inner Function เพราะต้องการเข้าถึงตัวแปร div)
  function centerInBrowser() {
    //หาขนาดพื้นที่แสดงผลของบราวเซอร์  โดยใช้ฟังก์ชั่นที่เราสร้างเอง
    var viewport = getBrowserDimension();
    //หาตำแหน่งของขอบด้านซ้ายและด้านบนของ div ที่จะทำให้ div อยู่กึ่งกลางพื้นที่แสดงผล
    var left = parseInt((viewport.width - div.offsetWidth) / 2);
    var top = parseInt((viewport.height - div.offsetHeight) / 2);

    //ถ้า left เป็นค่าลบ (กรณีความกว้างของพื้นที่แสดงผลในบราวเซอร์น้อยกว่าความกว้างของ div) ให้แสดงภาพชิดขอบด้านซ้ายของบราวเซอร์
    if (left < 0) { left = 0 };
    //ถ้า top เป็นค่าลบ (กรณีความสูงของพื้นที่แสดงผลในบราวเซอร์น้อยกว่าความสูงของ div) ให้แสดงภาพชิดขอบด้านบนของบราวเซอร์
    if (top < 0) { top = 0 };

    //ย้าย div ไปยังตำแหน่งที่คำนวณไว้
    div.style.left = left + "px";
    div.style.top = top + "px";
  }
}

//ฟังก์ชั่นที่จะทำงานเมื่อผู้ใช้คลิกภาพขนาดจริง การทำงานคือ จะกำหนด z-index ของ div ที่บรรจุภาพนั้นไว้ใหม่ เพื่อแสดงภาพออกมาข้างหน้าสุด
function onClickImage() {
  //เนื่องจากฟังก์ชั่นนี้ผูกกับอีเวนต์ onload ของภาพ ดังนั้น this จึงหมายถึงภาพนั้นๆ และ this.parentNode จะหมายถึง div ที่บรรจุภาพไว้
  var containerDiv = this.parentNode;

  //ถ้าหาก z-index ของ div ที่บรรจุภาพนั้นไว้ น้อยกว่าค่าของ lastZIndex
  if (containerDiv.style.zIndex < lastZIndex) {
    //เพิ่มค่าของตัวแปร lastZIndex ขึ้น 1 แล้วนำค่านั้นมากำหนดให้กับ z-index ของ div ที่บรรจุภาพไว้
    containerDiv.style.zIndex = ++lastZIndex;
  }
}

//ฟังก์ชั่นที่จะทำงานเมื่อผู้ใช้ดับเบิลคลิกภาพขนาดจริง การทำงานคือ จะปิดภาพลงไป
function onDoubleClickImage() {
  var containerDiv = this.parentNode;
  
  //ลบ div ที่บรรจุภาพไว้ทิ้งไป ซึ่งจะทำให้ภาพและ infoDiv ถูกลบทิ้งไปด้วย
  containerDiv.parentNode.removeChild(containerDiv);
  containerDiv = null;
}

//ฟังก์ชั่นที่ใช้หาขนาดพื้นที่แสดงผลของบราวเซอร์ 
function getBrowserDimension() {
  var intW = 0, intH = 0;

  //หาความกว้างและความสูงของพื้นที่แสดงผลในบราวเซอร์ ซึ่งความจริงไม่ยาก แต่สาเหตุที่ต้องแยกการทำงานเป็นหลายทาง ก็เพื่อให้ใช้ได้กับบราวเซอร์ทุกตัว เพราะบราวเซอร์แต่ละตัวจะบอกข้อมูลนี้ด้วยพร็อพเพอร์ตี้ที่แตกต่างกันไป
  if (window.innerWidth) {
    intW = window.innerWidth;
    intH = window.innerHeight;
  } 
  else {
    if (document.documentElement && document.documentElement.clientWidth) {
      intW = document.documentElement.clientWidth;
      intH = document.documentElement.clientHeight;
    }
    else if (document.body) {
      intW = document.body.clientWidth;
      intH = document.body.clientHeight;
    }
  }

  //ส่งคืนค่าออกไปในรูปของออบเจ็ค (Hash)
  return {
    width: parseInt(intW), 
    height: parseInt(intH)
  };
}

/**********************************************************************************
// ส่วนนี้สำหรับจัดการการคลิกลากรูปภาพ แต่ไม่เอาเพราะใช้ความสามารถของ script.aculo.us แทน
//*********************************************************************************

function handleDragDrop() {
  var bMouseDown = false;
  var x, y;
  var div = null;

  function mouseDown(e) {
    var e = new mouseEvent(e);

    if (e.target.className == "drag") {
      bMouseDown = true;
      div = e.target;
      x = e.x;
      y = e.y;
    }
  }

  function mouseUp(e) {
    bMouseDown = false;
    div = null;
  }

  function mouseMove(e) {
    if (bMouseDown && div) {
      var e = new mouseEvent(e);

      div.style.left = (parseInt(div.style.left) + (e.x - x)) + "px";
      div.style.top = (parseInt(div.style.top) + (e.y - y)) + "px";
      x = e.x;
      y = e.y;
    }
  }

  function mouseEvent(e) {
    if (e)
      this.e = e;
    else
      this.e = window.event;

    if (this.e.pageX)
      this.x = e.pageX;
    else
      this.x = window.event.clientX;
    
    if (this.e.pageY)
      this.y = e.pageY;
    else
      this.y = window.event.clientY;

    if (this.e.target)
      this.target = e.target;
    else
      this.target = window.event.srcElement;
  }

  document.onmousedown = mouseDown;
  document.onmouseup = mouseUp;
  document.onmousemove = mouseMove;
}

handleDragDrop();
**********************************************************************************/
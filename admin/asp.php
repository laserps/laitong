<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
 <head>
  <title>West Suit Management 1.0</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" href="styles.css" type="text/css">
 </head>
 <body>
 <!-- #include file = "connect_db.inc" -->
 <%
	' ดูข้อมูลลูกค้า
	Set objRsTblOrder = Server.CreateObject("ADODB.Recordset")
	objRsTblOrder.Open "SELECT * FROM tblOrder", objConnCustomer, 1, 3

	' ชื่อทีมงาน
	Set objRsTblOrderTeam = Server.CreateObject("ADODB.Recordset")
	objRsTblOrderTeam.Open "SELECT * FROM tblOrderTeam", objConnCustomer, 1, 3

	' ประเภทชุด
	Set objTblOrderSuitType = Server.CreateObject("ADODB.Recordset")
	objTblOrderSuitType.Open "SELECT * FROM tblOrderSuitType", objConnCustomer, 1, 3

	intCountRecord = objRsTblOrder.RecordCount ' นับจำนวน Record ทั้งหมด
 %>
 	<form name="Frm_ViewData" method="post" action="do_search_data.asp">
	<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td align="center" valign="middle">
				<table width="650" border="0" cellspacing="0" cellpadding="5" align="center" bgColor="#CCFFCC" style="border:1px dashed #999999">
					<tr>
						<td align="left" valign="middle">
							<h1 style="text-align:center">ค้นหาและแก้ไขข้อมูล</h1>
							ตอนนี้มีข้อมูลทั้งหมด <b><%=intCountRecord%></b> รายการ<br>
						</td>
					</tr>
					<tr>
						<td align="left" valign="middle">
								<select name="Order_Or_Appointment">
									<option value="0" selected>วันที่มาตัด</option>
									<option value="1">วันที่นัด</option>
								</select>
								ระหว่าง 
								<select name="View_Date_Begin_Date">
									<option value="0" selected>00</option>
									<%
										For d = 1 To 31
										If (d < 10) Then dd = "0" & CStr(d) Else dd = CStr(d) End If
									%>
									<option value="<%=CStr(dd)%>"><%=CStr(dd)%></option>
									<%Next%>
								</select>
								<select name="View_Date_Begin_Month">
									<%
										For m = 1 To 12
										If (m < 10) Then mm = "0" & CStr(m) Else mm = CStr(m) End If
										If (m = Month(Now)) Then sl_m = " selected" Else sl_m = "" End If
									%>
									<option value="<%=CStr(mm)%>"<%=sl_m%>><%=MonthName(mm)%></option>
									<%next%>
								</select>
								<select name="View_Date_Begin_Year">
									<%
										For y = (Year(Now) + 540) To (Year(Now) + 546)
										If y = (Year(Now) +543) Then sl_y = " selected" Else sl_y="" End If
									%>
									<option value="<%=CStr(y)%>"<%=sl_y%>><%=CStr(y)%></option>
									<%next%>
								</select>
							ถึง 
								<select name="View_Date_End_Date">
									<option value="0" selected>00</option>
									<%
										For d = 1 To 31
										If (d < 10) Then dd = "0" & CStr(d) Else dd = CStr(d) End If
									%>
									<option value="<%=CStr(dd)%>"><%=CStr(dd)%></option>
									<%Next%>
								</select>
								<select name="View_Date_End_Month">
									<%
										For m = 1 To 12
										If (m < 10) Then mm = "0" & CStr(m) Else mm = CStr(m) End If
										If (m = Month(Now)) Then sl_m = " selected" Else sl_m = "" End If
									%>
									<option value="<%=CStr(mm)%>"<%=sl_m%>><%=MonthName(mm)%></option>
									<%next%>
								</select>
								<select name="View_Date_End_Year">
									<%
										For y = (Year(Now) + 540) To (Year(Now) + 546)
										If y = (Year(Now) +543) Then sl_y = " selected" Else sl_y="" End If
									%>
									<option value="<%=CStr(y)%>"<%=sl_y%>><%=CStr(y)%></option>
									<%next%>
								</select>
						</td>
					</tr>
					<tr>
						<td align="left" valign="middle">
							เลขที่รายการ: <input type="text" name="OrderNo" maxlength="15" size="15"> 
							ชื่อทีมงาน: <select name="Order_Team">
								<option value="0" selected>ไม่ระบุ</option>
								<%
									Do While Not objRsTblOrderTeam.EOF
										Response.Write "<option value=" & objRsTblOrderTeam("OrderTeamID") & ">" & objRsTblOrderTeam("OrderTeamName") & "</option>"
										objRsTblOrderTeam.MoveNext
									Loop
								%>
							</select>
						</td>
					</tr>
					<tr>
						<td align="left" valign="middle">
							ประเภทชุด: 
							<select name="Suit_Type">
							<option value="0" selected>ดูทั้งหมด</option>
							<%
								Do While Not objTblOrderSuitType.EOF
									Response.Write "<option value='" & objTblOrderSuitType("OrderSuitTypeID") & "'>" & objTblOrderSuitType("OrderSuitType") & "</option>"
									objTblOrderSuitType.MoveNext
								Loop
							%>
							</select>
							การดำเนินการ:
							<select name="Processing">
								<option value="0" selected>ดูทั้งหมด</option>
								<option value="1">ยังไม่ตัด</option>
								<option value="2">กำลังดำเนินการ</option>
								<option value="3">เสร็จแล้ว</option>
								<option value="4">รับไปแล้ว</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align="left" valign="middle">
							ชื่อ: <input type="text" name="CustomerFirstName" maxlength="20" size="20">
						  สกุล: <input type="text" name="CustomerLastName" maxlength="20" size="20">
						</td>
					</tr>
					<tr>
						<td align="left" valign="middle">
							มือถือ1: <input type="text" name="Mobile1" maxlength="15" size="15"> มือถือ2: <input type="text" name="Mobile2" maxlength="15" size="15"> เบอร์บ้าน/ที่ทำงาน: <input type="text" name="HomeOfficePhone" maxlength="15" size="15">
						</td>
					</tr>
					<tr>
						<td align="left" valign="middle">
							<center><input type="submit" value="ดูข้อมูล">&nbsp;<input type="reset" value="ล้างแบบฟอร์ม"></center>
						</td>
					</tr>
					<tr>
						<td align="left" valign="middle">
							<center><a href="default.html">กลับเมนูหลัก</a></center>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	</form>
 </body>
</html>
<%
	' ปิด Recordset ทั้งหมด
	objRsTblOrder.Close
	objConnCustomer.Close

	Set objRsTblOrder = Nothing
	Set objConnCustomer = Nothing
%>
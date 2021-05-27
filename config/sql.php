<?php

$_SQL = array(
    'staff-list' => "SELECT
                    	  StaffID
                    	, CurrentStaff
                    	, Username
                    	, Phone1
                    	, ExtNo
                    	, FirstName
                    	, LastName
                    	, Email3
                    	, CONVERT(char(10), JoinDate, 126) AS JoinDate
                    	, FullPart
                    	, CASE Department
                    		WHEN 1 THEN 'Administration'
                    		WHEN 2 THEN 'Teachers'
                    		WHEN 3 THEN 'Sat-E Instructor'
                    		WHEN 4 THEN 'Student Services'
                    		WHEN 5 THEN 'Boarding-FT'
                    		WHEN 6 THEN 'Boarding-PT'
                    		WHEN 7 THEN 'Support' END AS Department
                    	, PositionTitle
                    FROM
                    	tblStaff
                    WHERE
                    	CurrentStaff = 'Y' and SchoolID = 'BHS'-- and Department in ('1','2','4','5','6')
                    ORDER BY
                    	SchoolID ASc
                    	, Department ASc
                    	, PositionTitle ASc
                    	, Email3 ASc",

      'student-list' => "SELECT s.StudentID,
                          FirstName,
                          LAStName,
                          EnglishName,
                          SchoolEmail,
                          CONVERT(char(10), ReportToSchoolDate, 126) AS ReportToSchoolDate,
                          i.expectedterm
                          FROM tblBHSStudent AS s
                          LEFT Join tblBHSStudentInfo AS i on s.StudentID = i.StudentID
                          WHERE SchoolID = 'BHS' AND CurrentStudent = 'Y' ",

      'incoming-student-list' => "SELECT *
                                  FROM tblBHSStudent
																	where CurrentStudent = 'A' and EnrolmentDate >= '2019-01-02'",

			'device-list' => "SELECT
													d.StudentID,
													s.FirstName + ' ' + s.LAStName AS FullName,
													s.EnglishName,
													s.CurrentStudent,
                          CONVERT(char(10), s.EnrolmentDate, 126) AS EnrolmentDate,
													d.DeviceID,
													d.DeviceCategory,
													d.BHSDNo,
													d.DeviceType,
													d.MACAddress,
													d.Network,
													d.NetworkRegStatus,
													d.DeviceStatus,
													s.LeftDate
												FROM
													tblBHSStudentEndDevice AS d
												LEFT JOIN
													tblBHSStudent AS s
												ON
													d.StudentID = s.StudentID
												WHERE
													(s.CurrentStudent in ('Y', 'A', 'R'))
													OR
													(s.CurrentStudent in ('N')
													AND ISNULL(s.LeftDate,GETDATE()) >= DATEADD(Year,-3,GETDATE()))
												ORDER BY
													FullName ASC, d.DeviceCategory ASC, d.ModifyDate DESC",

			'student-info' => "SELECT
													s.StudentID,
													s.FirstName,
													s.LastName,
													ISNULL(s.EnglishName, '') EnglishName,
													s.EnrolmentDate,
													s.CurrentStudent,
													c.CName,
													s.Counselor,
													t.Halls,
													t.Residence,
													t.Homestay,
                          s.Houses,
													t.RoomNo,
													t.Hadvisor
												FROM
													tblBHSStudent s
												LEFT JOIN
													tblCountry c
												ON
													s.Origin = c.CID
												LEFT JOIN
													tblBHSHomestay t
												ON
													s.StudentID = t.StudentID
												WHERE
													s.StudentID = ?",

			'device-info' => "SELECT
													d.DeviceID,
													d.DeviceCategory,
													d.BHSDNo,
													d.DeviceType,
													d.MACAddress,
													d.Network,
													d.NetworkRegStatus,
													d.DeviceStatus,
													d.ModifyDate,
													s.CurrentStudent
												FROM tblBHSStudentEndDevice AS d
												LEFT JOIN tblBHSStudent AS s
												ON d.StudentID = s.StudentID
												WHERE d.StudentID = ?",

			'get-one-device' => "SELECT
														DeviceID,
														DeviceCategory,
														BHSDNo,
														DeviceType,
														MACAddress,
														Network,
														NetworkRegStatus,
														DeviceStatus,
														Remarks,
														Make,
														Model,
														ModifyDate,
														s.FirstName + ' ' + s.LAStName AS ModifyStaff
													FROM
														tblBHSStudentEndDevice d
													LEFT JOIN
														tblStaff s
													ON
														d.ModifyUserID = s.StaffID
													WHERE
														DeviceID = ?",

			'update-BHSD' => "UPDATE
													tblBHSStudentEndDevice
												SET
													Make = :Manufacturer, Model = :Model, MACAddress = :MacAddress, NetworkRegStatus = :Network, DeviceStatus = :Usage,	BHSDNo = :BHSDNum, Remarks = :Remark, ModifyDate = :ModifyDate, ModifyUserID = :ModifyUserID
												WHERE
													DeviceID = :DeviceId",

			'update-BYOD' => "UPDATE
													tblBHSStudentEndDevice
												SET
													Make = :Manufacturer, Model = :Model, MACAddress = :MacAddress, NetworkRegStatus = :Network, DeviceStatus = :Usage,	DeviceType = :DeviceType, Remarks = :Remark, ModifyDate = :ModifyDate, ModifyUserID = :ModifyUserID
												WHERE
													DeviceID = :DeviceId",

			'update-LOANER' => "UPDATE
													tblBHSStudentEndDevice
												SET
													Make = :Manufacturer, Model = :Model, NetworkRegStatus = :Network, DeviceStatus = :Usage,	BHSDNo = :BHSDNum, DeviceType = :DeviceType, Remarks = :Remark, ModifyDate = :ModifyDate, ModifyUserID = :ModifyUserID
												WHERE
													DeviceID = :DeviceId",

        'insert-device-info' => "INSERT INTO tblBHSStudentEndDevice
                   (StudentID
                   ,DeviceCategory
                   ,DeviceType
                   ,Make
                   ,Model
                   ,MACAddress
                   ,Network
                   ,NetworkRegStatus
                   ,DeviceStatus
                   ,BHSDNo
                   ,Remarks
                   ,ModifyUserID
                   ,CreateUserID)
             VALUES
                   (:StudentID,
                    :DeviceCategory,
                    :DeviceType,
                    :Make,
                    :Model,
                    :MACAddress,
                    :Network,
                    :NetworkRegStatus,
                    :DeviceStatus,
                    :BHSDNo,
                    :Remarks,
                    :ModifyUserID,
										:CreateUserID)",


			'search-student' => "SELECT StudentID,
      FirstName,
      LastName,
      EnglishName,
      CurrentStudent,
      SchoolEmail,
      CASE
        WHEN CurrentStudent = 'Y' THEN 'Current'
        WHEN CurrentStudent = 'N' THEN 'Not Current'
        ELSE 'Error'
      END as 'CurrentStatus'
      FROM tblBHSStudent
      WHERE (replace(LastName,' ','')  LIKE ? OR replace(FirstName,' ','')
      LIKE ? OR EnglishName LIKE ? OR replace(StudentID,' ','')  LIKE ?)
      AND CurrentStudent IN ('Y','N') AND SchoolID = 'BHS' AND StudentID >= 201500001
      ORDER BY CurrentStudent DESC, FirstName ASC",

      'num-of-students-by-status-and-reg' => "SELECT CASE CurrentStudent
          WHEN 'A' THEN 'new'
          WHEN 'Y' THEN 'current'
          WHEN 'N' THEN 'notcurrent'
          ELSE 'notcurrent'
      END CurrentStudent, ISNULL(DeviceCategory,'') DeviceCategory, ISNULL(NetworkRegStatus,'') NetworkRegStatus, COUNT(DISTINCT d.DeviceID) NOS
        FROM tblBHSStudentEndDevice d
        LEFT JOIN tblBHSStudent s on s.StudentID = d.StudentID
        group by CurrentStudent, DeviceCategory, NetworkRegStatus",

      'num-of-students-by-status' => "SELECT CASE CurrentStudent
          WHEN 'A' THEN 'new'
          WHEN 'Y' THEN 'current'
          WHEN 'N' THEN 'notcurrent'
          ELSE 'notcurrent'
      END CurrentStudent, COUNT(DISTINCT d.studentID) NOS
        FROM tblBHSStudentEndDevice d
        LEFT JOIN tblBHSStudent s on s.StudentID = d.StudentID
        group by CurrentStudent",

      'num-of-loaner-device-by-status' => "SELECT CASE CurrentStudent
          WHEN 'A' THEN 'new'
          WHEN 'Y' THEN 'current'
          WHEN 'N' THEN 'notcurrent'
          ELSE 'notcurrent'
      END CurrentStudent, DeviceCategory, DeviceStatus, COUNT(DISTINCT d.DeviceID) NOS
        FROM tblBHSStudentEndDevice d
        LEFT JOIN tblBHSStudent s on s.StudentID = d.StudentID
		WHERE d.DeviceCategory = 'LOANER'
        group by CurrentStudent, DeviceCategory, DeviceStatus",

      'term-list' => "SELECT SemesterID,SemesterName
            ,CONVERT(char(10), StartDate, 126) AS StartDate
            ,CONVERT(char(10), EndDate, 126) AS EndDate
            ,CONVERT(char(10), MidCutOffDate, 126) AS MidCutOffDate
            ,CurrentSemester
            ,FExam1
            ,FExam2
            ,CONVERT(char(10), NextStartDate, 126) AS NextStartDate
        FROM tblBHSSemester
        WHERE CurrentSemester = 'Y'",

      'current-person' => "SELECT COUNT(SchoolID) numOfPeople FROM tblBHSStudent WHERE CurrentStudent = 'Y'
            UNION
            SELECT COUNT(SchoolID) numOfPeople FROM tblStaff WHERE CurrentStaff = 'Y' and SchoolID = 'BHS'",

      'count-device' => "SELECT COUNT(DeviceID) num
            FROM tblBHSStudentEndDevice
						WHERE StudentID = ?",

			'register-filtered-data' => "UPDATE
																			tblBHSStudentEndDevice
																		Set
																			NetworkRegStatus = '{Status}',
																			ModifyDate = '{ModifyDate}',
																			ModifyUserID = '{ModifyUserID}'
																		WHERE
																			DeviceID IN ({DeviceID})",

      'update-filtered-device-status-data' => "UPDATE
                                      tblBHSStudentEndDevice
                                    Set
                                      DeviceStatus = '{Status}',
                                      ModifyDate = '{ModifyDate}',
                                      ModifyUserID = '{ModifyUserID}'
                                    WHERE
                                      DeviceID IN ({DeviceID})",

      'staff-user-counts' => "SELECT ISNULL(Department2, 'N/A') Department2,
      SUM(CASE WHEN SchoolID!='' THEN 1 ELSE 0 END) AS TOTALNOS,
      SUM(CASE WHEN SchoolID='BHS' THEN 1 ELSE 0 END) AS BHSNOS,
      SUM(CASE WHEN SchoolID='BSS' THEN 1 ELSE 0 END) AS BSSNOS,
      SUM(CASE WHEN SchoolID='BCL' THEN 1 ELSE 0 END) AS BCLNOS,
      SUM(CASE WHEN SchoolID='BCI' THEN 1 ELSE 0 END) AS BCINOS
        FROM tblStaff
        WHERE CurrentStaff = 'Y'
        GROUP BY Department2
        ORDER BY Department2 ASC",

      'request-reset-email' => "SELECT R.*
      FROM tblBHSResetSchoolEmail R",

      'update-reset-email-request-status' => "UPDATE
													tblBHSResetSchoolEmail
												SET
													StudentID = '{StudentID}', Status='{Status}', Comment='{Comment}', ModifyDate = '{ModifyDate}', ModifyUserID = '{ModifyUserID}'
												WHERE
													ResetID = '{ResetID}'",

      'find-staff-email-by-name' => "SELECT StaffID,
    	   Email3
      FROM tblStaff
      where CurrentStaff = 'Y' AND concat(FirstName, ' ', LastName) = ?",

      'return-device-list' => "SELECT s.FirstName, s.LastName, s.EnglishName, s.SchoolEmail, s.Counselor, r.*
  FROM tblBHSReturnDevices r
  LEFT JOIN tblBHSStudent s on s.StudentID = r.StudentID",

      'update-return-device-list' => "UPDATE tblBHSReturnDevices SET ReturnStatus = '{ReturnStatus}', BHSDID = '{BHSDID}', ServiceTag = '{ServiceTag}',rAssetLabels = '{rAssetLabels}', rTablet = '{rTablet}', rKeyboard = '{rKeyboard}',  rPen = '{rPen}',rPower = '{rPower}', InspectionResult = '{InspectionResult}', DeductCheck = '{DeductCheck}',  DeductionAmount = '{DeductionAmount}',  InspectionDate = '{InspectionDate}' ,ModifyDate = '{ModifyDate}', ModifyUserID = '{ModifyUserID}' WHERE returnId = '{returnId}'",

      'search-staff' => "SELECT * FROM tblStaff
      WHERE (replace(CONCAT(FirstName, LastName, ''),' ','')  LIKE ? OR replace(StaffID,' ','') LIKE ?) ORDER BY CurrentStaff DESC",

      'update-staff' => "UPDATE tblStaff SET Department2 = '{Department2}', PositionTitle2 = '{PositionTitle2}', MealTagID = '{MealTagID}', Email3 = '{Email3}' WHERE StaffID = '{StaffID}'",

      'insert-bhs-return-plan' =>"INSERT INTO tblBHSReturnDevices
       (StudentID,ReturnDevices,ReturnOptions,AuthDate,AuthUser,ModifyUserID,CreateUserID)
       VALUES
         ('{StudentID}','{ReturnDevices}','{ReturnOptions}','{AuthDate}','{AuthUser}','{ModifyUserID}','{CreateUserID}')",

      'search-bhs-return-plan' => "SELECT StudentID FROM tblBHSReturnDevices WHERE StudentID = ?",

      'get-asset-master' => "SELECT
    CASE WHEN left(UserID, 1) like '[0-9]'
	THEN
	(SELECT CONCAT(CONCAT(FirstName, ' ', LastName), ' ', EnglishName) FROM tblBHSStudent WHERE UserID = StudentID)
	WHEN UserID IS NULL
	THEN ''
    ELSE
	(SELECT CONCAT(FirstName, ' ', LastName) FROM tblStaff WHERE UserID = StaffID)
    END AS FullName
	,*
  FROM tblBHSAssetMaster ORDER BY BHSDID ASC",

    'update-asset-master' => "UPDATE tblBHSAssetMaster
    SET Manufacturer = :Manufacturer, Model = :Model, BHSDYear = :BHSDYear, Ownership = :Ownership, SerialNo = :SerialNo,
    	BHSDID = :BHSDID, StockStatus = :StockStatus, DeviceStatus = :DeviceStatus, AssetRemark = :AssetRemark,
      UserID = :UserID, Username = :Username, UserRemark = :UserRemark --, ModifyDate = :ModifyDate, ModifyUserID = :ModifyUserID
    WHERE AssetID = :AssetID",

    'insert-asset-master-history' => "INSERT INTO tblBHSAssetMasterHistory
    (AssetID,StockStatus,PrevStockStatus,DeviceStatus,PrevDeviceStatus,AssetRemark
      ,PrevAssetRemark,UserRemark,PrevUserRemark,UserID,PrevUserID,CreateUserID)
    VALUES (:AssetID,:StockStatus,:PrevStockStatus,:DeviceStatus,:PrevDeviceStatus,:AssetRemark
      ,:PrevAssetRemark,:UserRemark,:PrevUserRemark,:UserID,:PrevUserID,:CreateUserID)
    ",

    'get-asset-master-history' => "SELECT A.*, CONVERT(char(10), A.CreateDate, 126) AS cDate, CONCAT(S.FirstName,' ' ,S.LastName) Fullname FROM tblBHSAssetMasterHistory A
    LEFT JOIN tblStaff S ON A.CreateUserID = S.StaffID
    WHERE AssetID = :AssetID
    ",

    'update-asset-master-from-return-device' => "UPDATE tblBHSAssetMaster SET StockStatus = :StockStatus, DeviceStatus = :DeviceStatus WHERE BHSDID = :BHSDID",

    );



?>

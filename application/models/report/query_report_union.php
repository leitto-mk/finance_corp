SELECT 
	school.SchoolName,
    class.ClassDesc,
    room.RoomDesc,
    prof.NIS,
    bio.FirstName,
    bio.MiddleName,
    bio.LastName,
    prof.Phone,
    prof.HousePhone
FROM tbl_02_school AS school
JOIN tbl_03_class AS class
	ON school.SchoolID = class.SchoolID
JOIN tbl_04_class_rooms AS room
	ON class.ClassID = room.ClassID
JOIN tbl_08_job_info_std AS prof
	ON room.RoomDesc = prof.Ruangan
LEFT JOIN tbl_07_personal_bio AS bio
	ON prof.NIS = bio.IDNumber
WHERE room.RoomDesc = 'XII BM-AK (A)'
UNION ALL
SELECT 
	school.SchoolName,
    class.ClassDesc,
    room.RoomDesc,
    prof.NIS,
    bio.FirstName,
    bio.MiddleName,
    bio.LastName,
    prof.Phone,
    prof.HousePhone
FROM tbl_02_school AS school
JOIN tbl_03_b_class_vocational AS class
	ON school.SchoolID = class.SchoolID
JOIN tbl_04_class_rooms_vocational AS room
	ON class.ClassDesc = room.Simplified
JOIN tbl_08_job_info_std AS prof
	ON room.RoomDesc = prof.Ruangan
LEFT JOIN tbl_07_personal_bio AS bio
	ON prof.NIS = bio.IDNumber
WHERE room.RoomDesc = 'XII BM-AK (A)'


if(school == 'ALL'){
	SELECT * tbl_08
}else{
	if(class == 'ALL'){
		SELECT 
			school.SchoolName,
		    class.ClassDesc,
		    room.RoomDesc,
		    prof.NIS
		FROM tbl_02_school AS school
		JOIN tbl_03_class AS class
			ON school.SchoolID = class.SchoolID
		JOIN tbl_04_class_rooms AS room
			ON class.ClassID = room.ClassID
		JOIN tbl_08_job_info_std AS prof
			ON room.RoomDesc = prof.Ruangan
		WHERE school.SchoolID = '$sch'
		UNION ALL
		SELECT 
			school.SchoolName,
		    class.ClassDesc,
		    room.RoomDesc,
		    prof.NIS
		FROM tbl_02_school AS school
		JOIN tbl_03_b_class_vocational AS class
			ON school.SchoolID = class.SchoolID
		JOIN tbl_04_class_rooms_vocational AS room
			ON class.ClassDesc = room.Simplified
		JOIN tbl_08_job_info_std AS prof
			ON room.RoomDesc = prof.Ruangan
		WHERE school.SchoolID = '$sch'
	}else{
		if(room == 'ALL'){
			SELECT 
				school.SchoolName,
			    class.ClassDesc,
			    room.RoomDesc,
			    prof.NIS
			FROM tbl_02_school AS school
			JOIN tbl_03_class AS class
				ON school.SchoolID = class.SchoolID
			JOIN tbl_04_class_rooms AS room
				ON class.ClassID = room.ClassID
			JOIN tbl_08_job_info_std AS prof
				ON room.RoomDesc = prof.Ruangan
			WHERE room.RoomDesc = '$cls'
			UNION ALL
			SELECT 
				school.SchoolName,
			    class.ClassDesc,
			    room.RoomDesc,
			    prof.NIS
			FROM tbl_02_school AS school
			JOIN tbl_03_b_class_vocational AS class
				ON school.SchoolID = class.SchoolID
			JOIN tbl_04_class_rooms_vocational AS room
				ON class.ClassDesc = room.Simplified
			JOIN tbl_08_job_info_std AS prof
				ON room.RoomDesc = prof.Ruangan
			WHERE class.ClassDesc = '$cls'
		}else{
			SELECT 
				school.SchoolName,
			    class.ClassDesc,
			    room.RoomDesc,
			    prof.NIS
			FROM tbl_02_school AS school
			JOIN tbl_03_class AS class
				ON school.SchoolID = class.SchoolID
			JOIN tbl_04_class_rooms AS room
				ON class.ClassID = room.ClassID
			JOIN tbl_08_job_info_std AS prof
				ON room.RoomDesc = prof.Ruangan
			WHERE room.RoomDesc = '$room'
			UNION ALL
			SELECT 
				school.SchoolName,
			    class.ClassDesc,
			    room.RoomDesc,
			    prof.NIS
			FROM tbl_02_school AS school
			JOIN tbl_03_b_class_vocational AS class
				ON school.SchoolID = class.SchoolID
			JOIN tbl_04_class_rooms_vocational AS room
				ON class.ClassDesc = room.Simplified
			JOIN tbl_08_job_info_std AS prof
				ON room.RoomDesc = prof.Ruangan
			WHERE room.RoomDesc = '$room'
		}
	}
}
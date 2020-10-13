DELIMITER//
BEGIN 
	SET @homeroom = homeroom;
    SET @semester = semester;
    SET @period = period;
    SET @sql = ''; 
    SELECT GROUP_CONCAT(
        DISTINCT 
            CONCAT( 'MAX(IF(SubjName = ''', SubjName, ''', MidRecap, 0)) AS ', REPLACE(SubjName, ' ','_') ) ) 
        INTO @sql 
        FROM tbl_09_det_grades 
        WHERE SubjName NOT IN('None','-')
        AND Room = @homeroom
        AND Semester = @semester
        AND schoolyear = @period
        ORDER BY SubjName ASC; 
       
    SET @sql = CONCAT('SELECT NIS, FullName, ', @sql ,' FROM tbl_09_det_grades WHERE Room = "',@homeroom,'" AND semester = "',@semester,'" AND schoolyear = "',@period,'" GROUP BY NIS ORDER BY FullName, SubjName ASC'); 
    
PREPARE stmt 
FROM @sql; 
EXECUTE stmt; 
DEALLOCATE PREPARE stmt; 

END//

DELIMITER;
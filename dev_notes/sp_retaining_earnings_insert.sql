DELIMITER $$
CREATE PROCEDURE `retaining_earnings_insert` (IN `val_branch` VARCHAR(255), IN `val_year` INT(11), IN `val_month` INT(11))
BEGIN
   START TRANSACTION;

   -- DELETE PREVIOUS DATA IF EXISTS --
   DELETE FROM `tbl_fa_retaining_earning`
   WHERE Branch = val_branch
   AND Year = val_year
   AND Month = val_month;

   -- REVENUE-EXPENSE EACH OF SELECTED MONTH --
   INSERT INTO `tbl_fa_retaining_earning` (Branch, Year, Month, Retaining)
   SELECT branch, year, month,
   (
     (
        SELECT SUM(Amount) FROM tbl_fa_transaction
        WHERE Branch = val_branch
        AND YEAR(TransDate) = val_year AND MONTH(TransDate) = val_month
        AND AccType IN ('R', 'R1')
     ) 
     -
     (
        SELECT SUM(Amount) FROM tbl_fa_transaction
        WHERE Branch = val_branch
        AND YEAR(TransDate) = val_year AND MONTH(TransDate) = val_month
        AND AccType IN ('E', 'E1')
     )
   ) AS retaining;

   -- SUM EACH OF SELECTED MONTH --
   UPDATE `tbl_fa_retaining_earning` AS parent
   SET RetainingSum = (
      SELECT SUM(Retaining) FROM tbl_fa_retaining_earning
      WHERE CtrlNo <= parent.CtrlNo
      AND Branch = val_branch
      AND Year = val_year
   )
   WHERE Branch = val_branch
   AND Year = val_year;

   COMMIT;
END $$
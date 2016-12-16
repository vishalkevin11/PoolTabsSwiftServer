
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 01, 2016 at 08:39 AM
-- Server version: 10.0.20-MariaDB
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u355642838_tpool`
--

-- --------------------------------------------------------

--
-- Table structure for table `LatLongs`
--

CREATE TABLE IF NOT EXISTS `LatLongs` (
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `routeId` bigint(20) NOT NULL,
  `distance` mediumtext NOT NULL,
  `duration` mediumtext NOT NULL,
  `htmlImstruction` mediumtext NOT NULL,
  `polyline` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LatLongs`
--

INSERT INTO `LatLongs` (`latitude`, `longitude`, `routeId`, `distance`, `duration`, `htmlImstruction`, `polyline`) VALUES
(12.9044745, 77.5922038, 1477913865, '0.1 km', '1 min', 'Turn left onto 14th Main RdDestination will be on the left', '}kwmAgvqxMnAFrA@XA'),
(12.9055696, 77.5931201, 1477913865, '0.2 km', '1 min', 'Turn left onto 17th D Cross Rd', 'yrwmA_|qxMn@@fAAh@BN@JBJDHFHHFJBJ@HCNEd@E|@'),
(12.9055778, 77.593471, 1477913865, '38 m', '1 min', 'Turn right toward 17th D Cross Rd', '{rwmAe~qxM@dA'),
(12.9073004, 77.6005741, 1477913865, '0.8 km', '3 mins', 'Turn left onto 100 Feet Ring Rd/15th Cross Rd/Outer Ring RdPass by HDFC Bank (on the left)', 's}wmAqjsxMbBdI`@pBLn@X|An@pDDPBNB?RARCp@BbBMvA?J?v@CvCI~A'),
(12.9062664, 77.5934777, 1477913865, '77 m', '1 min', 'Turn left onto 12th Main Rd', 'ewwmAg~qxMtA@r@?'),
(12.9054613, 77.6038292, 1477913865, '0.2 km', '1 min', 'Turn right onto 7th Cross RdPass by Sakhii Hospital (on the left)', 'crwmA}~sxM?zI?V'),
(12.905461, 77.6019687, 1477913865, '0.3 km', '1 min', 'Turn right onto Bannerghatta Main Rd', 'crwmAissxM@NG@C?MBOBKBIDKDGFKH]TsFdE'),
(12.9057759, 77.6038448, 1477913865, '35 m', '1 min', 'Turn left onto 4th Main Rd', 'ctwmA__txM~@@'),
(12.9056235, 77.6059093, 1477913865, '0.2 km', '1 min', 'Continue onto 7th Cross Rd', 'cswmA}ktxMEdBAd@IjBGpAErA'),
(12.9121228, 77.6158932, 1477913865, '0.1 km', '1 min', 'Turn right onto 4th Cross Rd', 'w{xmAijvxMO|AK`B'),
(12.9122597, 77.6149312, 1477913865, '1.6 km', '4 mins', 'Turn left onto 29th Main RdPass by SAHS (Sree Annapoorna Hospitality Services) (on the right)', 's|xmAidvxMX@f@FzBb@jATPBJ@fBDp@DTFNDXJn@Tx@X^LRHXJb@Lf@PD@HBt@Vz@Tj@Rf@NLDp@Nb@LVHdAZl@Pl@RB@t@Tl@RLFh@TDBBBDD@@@DBF?B?B?B?D?DARIt@Gx@?BGdAIx@Gr@Ed@Cb@OtAGXK^KVO`@ENKTQb@KTETCRAN@RBTDRBNFXDd@TjF@j@Ab@Aj@'),
(12.9152625, 77.616381, 1477913865, '0.4 km', '1 min', 'Continue onto Tank Shore RdDrive along the lake (on the left)', 'koymAkmvxMF@RFB?D?|G`@xBTtD^'),
(12.9174183, 77.6229115, 1477913865, '0.7 km', '3 mins', 'Turn right onto 100 Feet Ring Rd/Outer Ring RdPass by Pizza Hut (on the right in 300&nbsp;m)', '{|ymAevwxMRMVdABp@`DFXRv@TdARdAHVJZF^Fn@@x@@xBDdB@hAB|ACdA'),
(12.9161958, 77.6169474, 1477913865, '0.1 km', '1 min', 'Turn left toward Tank Shore Rd', 'guymA}pvxM^Lf@TtAz@P'),
(12.9194817, 77.6213822, 1477913865, '0.3 km', '1 min', 'Slight left toward 100 Feet Ring Rd/Outer Ring Rd', 'wizmAslwxMT_@NOROj@]l@a@j@_@nAs@xAs@p@i@'),
(12.9237618, 77.6187211, 1477913865, '0.2 km', '1 min', 'Merge onto Hosur RdPass by Khalsa School (on the right)', 'od{mA_|vxMd@[fAk@xAy@dAi@'),
(12.9224086, 77.6195791, 1477913865, '0.4 km', '1 min', 'Continue straight to stay on Hosur RdPass by More Super Market (on the left)', 'a|zmAkawxMdAk@|@a@RKxAq@HChCsAhBcAVOPMn@a@'),
(12.9259182, 77.6173242, 1477913865, '0.3 km', '1 min', 'Keep right to continue on Madiwala Underpass', '_r{mAgsvxMTKTMvDwBhAk@`CyA'),
(12.9343968, 77.6124467, 1477913865, '1.1 km', '4 mins', 'Turn left onto Hosur RdPass by Brigade Ct (on the left)', '_g}mAytuxM`KoE|CmAhAi@xCuAjAm@~@m@x@Y`G_DdFkCb@UpCsAv@c@'),
(12.9405695, 77.6175219, 1477913865, '83 m', '1 min', 'Turn left toward 1st A Main Road', 'qm~mAotvxMLaARsA'),
(12.9404046, 77.6182661, 1477913865, '0.5 km', '2 mins', 'Turn right onto 1st A Main Road', 'ol~mAeyvxMx@NF@t@Jz@N`APpKhBfDT'),
(12.9363152, 77.6173078, 1477913865, '0.6 km', '2 mins', 'Turn right after the park (on the left)Pass by Royal Arcade (on the left in 350&nbsp;m)', '_s}mAesvxM?t@?j@?LD~@@PDNDPR|@L^Th@RVhDpItArDRj@JT'),
(12.9407666, 77.6175653, 1477913865, '22 m', '1 min', 'Turn right onto 1st C Main Rd', 'yn~mAytvxMf@H'),
(12.9407623, 77.6167194, 1477913865, '92 m', '1 min', 'Turn right onto 1st C Cross Rd', 'wn~mAoovxM@o@CyB'),
(12.940125, 77.6165166, 1477913865, '74 m', '1 min', 'Head north on 1st East Main Rd toward 1st C Cross Rd', 'yj~mAgnvxM}Bg@');

-- --------------------------------------------------------

--
-- Table structure for table `Login`
--

CREATE TABLE IF NOT EXISTS `Login` (
  `username` text NOT NULL,
  `phonenumber` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `uniqueid` bigint(20) NOT NULL,
  PRIMARY KEY (`uniqueid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Login`
--

INSERT INTO `Login` (`username`, `phonenumber`, `email`, `password`, `uniqueid`) VALUES
('Kevin Vishal Saldanha', '9898765432', 'kevin.saldanha@tavant.com', '', 1477913283);

-- --------------------------------------------------------

--
-- Table structure for table `PoolTrip`
--

CREATE TABLE IF NOT EXISTS `PoolTrip` (
  `trip_path` longtext NOT NULL,
  `source_name` mediumtext NOT NULL,
  `destination_name` mediumtext NOT NULL,
  `time_leaving_source` mediumtext NOT NULL,
  `time_leaving_destination` mediumtext NOT NULL,
  `number_of_seats` int(11) NOT NULL,
  `traveller_type` int(11) NOT NULL,
  `trip_type` int(11) NOT NULL,
  `total_trip_time` mediumtext NOT NULL,
  `uniqueid_val` bigint(20) NOT NULL,
  `phonenumber_val` text NOT NULL,
  `email_val` text NOT NULL,
  `is_trip_live` int(11) NOT NULL,
  `source_lat` double NOT NULL,
  `source_lng` double NOT NULL,
  `destination_lat` double NOT NULL,
  `destination_lng` double NOT NULL,
  `total_trip_distance` mediumtext NOT NULL,
  `trip_via` mediumtext NOT NULL,
  `day1` int(11) NOT NULL,
  `day2` int(11) NOT NULL,
  `day3` int(11) NOT NULL,
  `day4` int(11) NOT NULL,
  `day5` int(11) NOT NULL,
  `day6` int(11) NOT NULL,
  `day7` int(11) NOT NULL,
  `schedule_type` int(11) NOT NULL,
  `tripDate` varchar(25) NOT NULL,
  PRIMARY KEY (`uniqueid_val`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PoolTrip`
--

INSERT INTO `PoolTrip` (`trip_path`, `source_name`, `destination_name`, `time_leaving_source`, `time_leaving_destination`, `number_of_seats`, `traveller_type`, `trip_type`, `total_trip_time`, `uniqueid_val`, `phonenumber_val`, `email_val`, `is_trip_live`, `source_lat`, `source_lng`, `destination_lat`, `destination_lng`, `total_trip_distance`, `trip_via`, `day1`, `day2`, `day3`, `day4`, `day5`, `day6`, `day7`, `schedule_type`, `tripDate`) VALUES
('', 'No.12, CSRIE-II, Guava Garden Layout, 5th Block, Koramangala, 5th Block, Koramangala, Bengaluru, Karnataka 560095, India', '5th Phase, J P Nagar Phase 5, JP Nagar, Bengaluru, Karnataka 560078, India', '08:07', '20:01', 1, 1, 2, '31 mins', 1477913865, '9898765432', 'kevin.saldanha@tavant.com', 1, 12.9337929, 77.6184343, 12.903517, 77.5920295, '8.3 km', 'Hosur Rd', 1, 1, 1, 1, 1, 0, 0, 2, '2016-Oct-31');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

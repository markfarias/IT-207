USE mfarias ;

-- -----------------------------------------------------
-- Table mfarias.Categories
-- -----------------------------------------------------
DROP TABLE IF EXISTS mfarias.Categories ;

CREATE  TABLE IF NOT EXISTS mfarias.Categories (
  CategoryId TINYINT PRIMARY KEY,
  CategoryName VARCHAR(30) NOT NULL )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table mfarias.MovieRatings
-- -----------------------------------------------------
DROP TABLE IF EXISTS mfarias.MovieRatings ;

CREATE  TABLE IF NOT EXISTS mfarias.MovieRatings (
  RatingId TINYINT PRIMARY KEY ,
  RatingName VARCHAR(5) NOT NULL )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table mfarias.ReleaseCompanies
-- -----------------------------------------------------
DROP TABLE IF EXISTS mfarias.ReleaseCompanies ;

CREATE  TABLE IF NOT EXISTS mfarias.ReleaseCompanies (
  CompanyId TINYINT PRIMARY KEY ,
  CompanyName VARCHAR(50) NOT NULL )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table mfarias.Movies
-- -----------------------------------------------------
DROP TABLE IF EXISTS mfarias.Movies ;

CREATE  TABLE IF NOT EXISTS mfarias.Movies (
  MovieId SMALLINT PRIMARY KEY AUTO_INCREMENT,
  MovieName VARCHAR(50) NOT NULL ,
  MovieCategory TINYINT NOT NULL ,
  ReleaseCompany TINYINT NOT NULL ,
  ReleaseYear CHAR(4) NOT NULL ,
  Description TEXT NOT NULL ,
  Rating TINYINT NOT NULL ,
  Price DECIMAL NOT NULL ,
  ShippingRate DECIMAL NOT NULL ,
  CoverImage BLOB NULL,
  INDEX FK_MoviesMovieRatings_idx (Rating ASC) ,
  INDEX FK_MoviesReleaseCompanies_idx (ReleaseCompany ASC) ,
  CONSTRAINT FK_MoviesMovieRatings
    FOREIGN KEY (Rating )
    REFERENCES mfarias.MovieRatings (RatingId )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT FK_MoviesReleaseCompanies
    FOREIGN KEY (ReleaseCompany )
    REFERENCES mfarias.ReleaseCompanies (CompanyId )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
	CONSTRAINT FK_MoviesCatetories
		FOREIGN KEY (MovieCategory)
		REFERENCES mfarias.Categories (CategoryId)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table mfarias.MovieReviews
-- -----------------------------------------------------
DROP TABLE IF EXISTS mfarias.MovieReviews ;

CREATE  TABLE IF NOT EXISTS mfarias.MovieReviews (
  ReviewId SMALLINT PRIMARY KEY AUTO_INCREMENT ,
  MovieId SMALLINT NOT NULL ,
  ReviewDate DATE NOT NULL ,
  ReviewScore TINYINT NOT NULL ,
  ReviewComments TEXT NULL ,
  INDEX FK_MovieReviewMovies_idx (MovieId ASC) ,
  CONSTRAINT FK_MovieReviewMovies
    FOREIGN KEY (MovieId )
    REFERENCES mfarias.Movies (MovieId )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table mfarias.Users
-- -----------------------------------------------------
DROP TABLE IF EXISTS mfarias.Users ;

CREATE  TABLE IF NOT EXISTS mfarias.Users (
	UserName VARCHAR(32) NOT NULL PRIMARY KEY,
	FirstName VARCHAR(25) NOT NULL ,
	LastName VARCHAR(30) NOT NULL ,
	EmailAddress VARCHAR(50) NOT NULL ,
	Administrator TINYINT(1) NOT NULL ,
	Password VARCHAR(20) NOT NULL )
ENGINE = InnoDB;

USE mfarias ;

-- -----------------------------------------------------
-- Load up the Movies Categories
-- -----------------------------------------------------
INSERT Categories(CategoryId, CategoryName)
VALUES 
(1, 'Action'),
(2, 'Adventure'),
(3, 'Comedy'),
(4, 'Documentary'),
(5, 'Romance'),
(6, 'Sci-Fi'),
(7, 'Horror');

-- -----------------------------------------------------
-- Load up the Movies Release Companies
-- -----------------------------------------------------
INSERT ReleaseCompanies(CompanyId, CompanyName)
VALUES
(1, '20th Century'),
(2, 'Dreamworks'),
(3, 'Lions Gate'),
(4, 'Pixar'),
(5, 'Universal'),
(6, 'Touchstone'),
(7, 'Warner Bros.');

-- -----------------------------------------------------
-- Load up the Movies Ratings
-- -----------------------------------------------------
INSERT MovieRatings(RatingId, RatingName)
VALUES
(1, 'G'),
(2, 'PG'),
(3, 'PG-13'),
(4, 'R'),
(5, 'NR');

-- -----------------------------------------------------
-- Load up the base Admin user record
-- -----------------------------------------------------
INSERT Users VALUES('admin','Admin','Admin','admin@masonlive.gmu.edu',1,'admin');
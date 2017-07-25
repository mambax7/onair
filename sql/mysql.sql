CREATE TABLE oa_program (
  oa_id          INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  oa_name        VARCHAR(50)     NOT NULL DEFAULT '',
  oa_station     VARCHAR(50)     NOT NULL DEFAULT '',
  oa_title       VARCHAR(50)     NOT NULL DEFAULT '',
  oa_day         VARCHAR(18)     NOT NULL DEFAULT '',
  oa_start       VARCHAR(15)     NOT NULL DEFAULT '',
  oa_stop        VARCHAR(15)     NOT NULL DEFAULT '',
  oa_image       TEXT            NOT NULL,
  oa_description TEXT            NOT NULL,
  oa_plugin      VARCHAR(50)     NOT NULL DEFAULT '',
  oa_stream      VARCHAR(75)     NOT NULL DEFAULT '',
  PRIMARY KEY (oa_id),
  --   UNIQUE KEY (oa_id2),
  --   KEY published_ihome (published,ihome),
  KEY title (oa_title(40))
  --   KEY created (created),
  -- FULLTEXT KEY search (title,hometext,bodytext)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 1;

CREATE TABLE oa_playlist (
  pl_id          INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  pl_station     VARCHAR(50)     NOT NULL DEFAULT '',
  pl_title       VARCHAR(50)     NOT NULL DEFAULT '',
  pl_day         VARCHAR(50)     NOT NULL DEFAULT '',
  pl_start       VARCHAR(20)     NOT NULL DEFAULT '',
  pl_stop        VARCHAR(20)     NOT NULL DEFAULT '',
  pl_image       TEXT            NOT NULL,
  pl_description TEXT            NOT NULL,
  pl_name        TEXT            NOT NULL,
  pl_date        DATE            NOT NULL,
  PRIMARY KEY (pl_id)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 1;


CREATE TABLE oa_hitlist (
  oa_songid   INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  oa_songsong VARCHAR(50)      NOT NULL DEFAULT '',
  oa_songtime VARCHAR(100)     NOT NULL DEFAULT '',
  oa_songday  VARCHAR(1)       NOT NULL,
  oa_songweek VARCHAR(2)       NOT NULL DEFAULT '',
  oa_songyear VARCHAR(4)       NOT NULL DEFAULT '',
  PRIMARY KEY (oa_songid)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 15;

CREATE TABLE oa_charts (
  ch_songid         INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  ch_songsong       VARCHAR(200)     NOT NULL DEFAULT '',
  ch_songweekstotal VARCHAR(3)       NOT NULL DEFAULT '',
  ch_songlastweek   VARCHAR(3)       NOT NULL,
  ch_songtopplace   VARCHAR(3)       NOT NULL DEFAULT '',
  ch_songthisweek   VARCHAR(3)       NOT NULL DEFAULT '',
  ch_songweek       VARCHAR(2)       NOT NULL DEFAULT '',
  ch_songplaytime   VARCHAR(8)       NOT NULL DEFAULT '',
  PRIMARY KEY (ch_songid)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 15;

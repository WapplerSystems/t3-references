CREATE TABLE tx_references_domain_model_reference
(
	name                  varchar(255)         NOT NULL DEFAULT '',
	slug                  varchar(255)         NOT NULL DEFAULT '',
	teaser                text                 NOT NULL DEFAULT '',
	description           text                 NOT NULL DEFAULT '',
	link                  varchar(255)         NOT NULL DEFAULT '',
	logo                  int(11) unsigned     NOT NULL DEFAULT '0',
	screenshot_smartphone int(11) unsigned     NOT NULL DEFAULT '0',
	screenshot_tablet     int(11) unsigned     NOT NULL DEFAULT '0',
	screenshot_laptop     int(11) unsigned     NOT NULL DEFAULT '0',
	screenshot_desktop    int(11) unsigned     NOT NULL DEFAULT '0',
	video                 int(11) unsigned     NOT NULL DEFAULT '0',
	technology            varchar(255)                  DEFAULT '' NOT NULL,
	industry              varchar(255)                  DEFAULT '' NOT NULL,
	target_group          int(11)                       DEFAULT '0' NOT NULL,
	country               varchar(255)                  DEFAULT '' NOT NULL,
	duration              varchar(255)         NOT NULL DEFAULT '',
	green_hosting         smallint(1) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_references_domain_model_reference
(
	categories int(11) unsigned DEFAULT '0' NOT NULL
);

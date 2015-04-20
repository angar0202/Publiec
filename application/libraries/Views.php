<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Views {

	/**
	TEMPLATE
	*/
	public $MAIN='template/main';	
	public $HEADER='template/header';
	public $MENU='template/menu';	
	public $CONTAINER='template/container';	

	/**
	HOME
	*/
	public $HOME_INDEX='home/index';
	public $PUBLICACIONES='home/publicaciones';	
	public $ACTIVIDAD_NEGOCIOS='home/actividad_negocios';
	public $MAPA='home/mapa';	

	/**
	MASTER
	*/
	public $NEGOCIO_INDEX='negocio/index';
	public $NEGOCIO_CREATE='negocio/create';
	public $NEGOCIO_EDIT='negocio/edit';
	public $NEGOCIO_DELETE='negocio/delete';
	public $TIPO_NEGOCIO_INDEX='tiponegocio/index';
	public $CATEGORIA_INDEX='categoria/index';
	public $USUARIO_INDEX='usuario/index';
	/**
	CONTROLES USUARIO
	*/
	public $PANEL_USUARIO='home/panel_usuario';
	public $MENU_USUARIO='home/menu_usuario';
	public $MENU_INVITADO='home/menu_invitado';
	public $MENU_ADMINISTRADOR='home/menu_administrador';	
	public $INFO_NEGOCIO='home/info_negocio';
	PUBLIC $PANEL_SUPERIOR='home/panel_superior';
	/**
	MODAL
	*/
	public $LOGIN='modal/login';
	public $REGISTRO='modal/registro';

	/**
	PLUGINS (Javascript)
	*/
	public $ELIMINAR_ARCHIVO='plugins/eliminarArchivo';
	public $VENTANA_MODALES='plugins/ventanasModales';	
	public $MAPAS='plugins/mapas';	
}
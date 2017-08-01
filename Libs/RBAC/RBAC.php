<?php 

namespace Libs\RBAC;

/**
 *  RBAC FACADE class
 *  Main class to manage users, sessions and their roles and permissions.
 *  To use it need to be cinitialized RBAC class, then needs to be checked session, and cookies, 
 *  if there is user, then new user is created for the RBAC depending on from where user is loaded.
 *  It might be loaded from database, XML file etc. 
 *  If session is epmty, the empty user is created.
 */
class RBAC {

	public function __construct(){}

	public function checkSession() {
		
	}

}
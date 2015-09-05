<?php

    return array(

        'initialize' => function($authority) {

            $user = $authority->getCurrentUser();

            // action aliases
            $authority->addAlias('client', array('read'));
            $authority->addAlias('person', array('add','read', 'update', 'delete'));

            // an example using the `hasRole` function, see below examples for more details
            if ($user->hasRole('admin')) {
                $authority->allow('admin', 'all');
            }

            // loop through each of the users permissions, and create rules
            foreach ($user->permissions as $perm) {
                if ($perm->type == 'allow') {
                    $authority->allow($perm->action, $perm->resource);
                } else {
                    $authority->deny($perm->action, $perm->resource);
                }
            }
        }

    );

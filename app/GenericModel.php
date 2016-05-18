<?php

namespace App;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class GenericModel extends Model
{
    protected $softDelete = true;
	use SoftDeletes;	

    protected function runSoftDelete()
	{
	    $query = $this->newQuery()->where($this->getKeyName(), $this->getKey());
	    $this->{$this->getDeletedAtColumn()} = $time = $this->freshTimestamp();
	    $deleted_by = (Authorizer::getResourceOwnerId()) ?: null;
	    $query->update(array(
	       $this->getDeletedAtColumn() => $this->fromDateTime($time), 
	       'deleted_by' => $deleted_by
	    ));
	}
}

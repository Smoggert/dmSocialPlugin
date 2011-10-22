<?php

/**
 * PluginDmSocialTokenTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginDmSocialTokenTable extends myDoctrineTable
{
    /**
     * Returns an instance of this class.
     *
     * @return PluginDmSocialTokenTable The table object
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginDmSocialToken');
    }
    
  protected function getByNameAndUserQuery($name, $user, $status = null)
  {
    $q = $this->createQuery('t');

    if(!is_null($name))
    {
      $q->where('t.name = ?', $name);
    }


    if($user instanceof DmUser)
    {
      $q->addWhere('t.user_id = ?', $user->getId());
    }
    else
    {
      $q->addWhere('t.user_id IS NULL');
    }

    if(!is_null($status))
    {
      $q->addWhere('t.status = ?', $status);
    }

    return $q;
  }

  public function findOneByNameAndUser($name, $user, $status = null)
  {
    $q = $this->getByNameAndUserQuery($name, $user, $status)
              ->limit(1);

    return $q->fetchOne();
  }

  public function findByNameAndUser($name, $user, $status = null)
  {
    $q = $this->getByNameAndUserQuery($name, $user, $status);

    return $q->execute();
  }

  public function findByUserAndStatus($name, $user, $status = null)
  {
    $q = $this->getByNameAndUserQuery(null, $user, $status);

    return $q->execute();
  }

  protected function getDeleteTokenQuery($name = null, $user = null, $status = null)
  {
    $q = Doctrine_Query::create()
        ->delete('DmSocialToken t');

    if(!is_null($status))
    {
      $q->where('t.status = ?', $status);
    }


    if(!is_null($name))
    {
      $q->addWhere('t.name = ?', $name);
    }

    if(!is_null($user) && $user instanceof DmUser)
    {
      $q->addWhere('t.user_id = ?', $user->getId());
    }

    return $q;
  }

  public function deleteTokens($name = null, $user = null, $status = null)
  {
    $q = $this->getDeleteTokenQuery($name, $user, $status);

    $q->execute();
  }

  public function findOneByNameAndIdentifier($name, $identifier)
  {
    $q = $this->createQuery('t')
              ->where('t.name = ?', $name)
              ->addWhere('t.identifier = ?', $identifier)
              ->limit(1);

    return $q->fetchOne();
  }
}

<?php
namespace BsDirectory\Model\Mapper;

interface DirectoryProfileInterface
{

    const DIRECTORY_PROFILE_STATUS_PUBLISHED = 'published';

    const DIRECTORY_PROFILE_STATUS_EXPIRED = 'expired';

    const DIRECTORY_PROFILE_STATUS_AWAITING_AUTH = 'awaiting auth';

    const DIRECTORY_PROFILE_STATUS_PAUSED = 'paused';

    /**
     * @return string|number
     */
    public function  getId();
    /**
     *
     * @return string $name
     */
    public function getName();

    /**
     *
     * @param string $name            
     */
    public function setName($name);

    /**
     *
     * @return string $status
     */
    public function getStatus();

    /**
     *
     * @param string $status            
     */
    public function setStatus($status);
}
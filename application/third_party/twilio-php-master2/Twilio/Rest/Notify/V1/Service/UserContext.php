<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Notify\V1\Service;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Rest\Notify\V1\Service\User\SegmentMembershipList;
use Twilio\Rest\Notify\V1\Service\User\UserBindingList;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 *
 * @property \Twilio\Rest\Notify\V1\Service\User\UserBindingList bindings
 * @property \Twilio\Rest\Notify\V1\Service\User\SegmentMembershipList segmentMemberships
 * @method \Twilio\Rest\Notify\V1\Service\User\UserBindingContext bindings(string $sid)
 * @method \Twilio\Rest\Notify\V1\Service\User\SegmentMembershipContext segmentMemberships(string $segment)
 */
class UserContext extends InstanceContext
{
    protected $_bindings = null;
    protected $_segmentMemberships = null;

    /**
     * Initialize the UserContext
     *
     * @param \Twilio\Version $version Version that contains the resource
     * @param string $serviceSid The service_sid
     * @param string $identity The identity
     * @return \Twilio\Rest\Notify\V1\Service\UserContext
     */
    public function __construct(Version $version, $serviceSid, $identity)
    {
        parent::__construct($version);

        // Path Solution
        $this->solution = array('serviceSid' => $serviceSid, 'identity' => $identity);

        $this->uri = '/Services/' . rawurlencode($serviceSid) . '/Users/' . rawurlencode($identity) . '';
    }

    /**
     * Deletes the UserInstance
     *
     * @return boolean True if delete succeeds, false otherwise
     */
    public function delete()
    {
        return $this->version->delete('delete', $this->uri);
    }

    /**
     * Fetch a UserInstance
     *
     * @return UserInstance Fetched UserInstance
     */
    public function fetch()
    {
        $params = Values::of(array());

        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );

        return new UserInstance(
            $this->version,
            $payload,
            $this->solution['serviceSid'],
            $this->solution['identity']
        );
    }

    /**
     * Access the bindings
     *
     * @return \Twilio\Rest\Notify\V1\Service\User\UserBindingList
     */
    protected function getBindings()
    {
        if (!$this->_bindings) {
            $this->_bindings = new UserBindingList(
                $this->version,
                $this->solution['serviceSid'],
                $this->solution['identity']
            );
        }

        return $this->_bindings;
    }

    /**
     * Access the segmentMemberships
     *
     * @return \Twilio\Rest\Notify\V1\Service\User\SegmentMembershipList
     */
    protected function getSegmentMemberships()
    {
        if (!$this->_segmentMemberships) {
            $this->_segmentMemberships = new SegmentMembershipList(
                $this->version,
                $this->solution['serviceSid'],
                $this->solution['identity']
            );
        }

        return $this->_segmentMemberships;
    }

    /**
     * Magic getter to lazy load subresources
     *
     * @param string $name Subresource to return
     * @return \Twilio\ListResource The requested subresource
     * @throws \Twilio\Exceptions\TwilioException For unknown subresources
     */
    public function __get($name)
    {
        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return \Twilio\InstanceContext The requested resource context
     * @throws \Twilio\Exceptions\TwilioException For unknown resource
     */
    public function __call($name, $arguments)
    {
        $property = $this->$name;
        if (method_exists($property, 'getContext')) {
            return call_user_func_array(array($property, 'getContext'), $arguments);
        }

        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString()
    {
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Notify.V1.UserContext ' . implode(' ', $context) . ']';
    }
}
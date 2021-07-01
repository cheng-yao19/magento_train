<?php
namespace Practice\Email\Block\Adminhtml;


use Magento\Framework\View\Element\Template;
use Magento\User\Model\ResourceModel\User;
use Magento\User\Model\UserFactory;

class Index extends Template
{

    /** @var UserFactory  */
    protected $userFactory;

    /**
     * @var User
     */
    protected $userResource;


    public function __construct(
        Template\Context $context,
        UserFactory $userFactory,
        User $userResource,
        array $data = []
    )
    {
        $this->userFactory = $userFactory;
        $this->userResource = $userResource;
        parent::__construct($context, $data);
    }

    public function getUserByEmail()
    {
        $email = $this->getRequest()->getParam('email');
        if (empty($email)) {
            return null;
        }
        $user = $this->userFactory->create();
        $this->userResource->load($user, $email, 'email');
        return $user;
    }

}
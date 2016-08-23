<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-03-05 at 12:01:38.
 */
class JGithubPackageRepositoriesTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var    JRegistry  Options for the GitHub object.
	 * @since  11.4
	 */
	protected $options;

	/**
	 * @var    JGithubHttp  Mock client object.
	 * @since  11.4
	 */
	protected $client;

	/**
	 * @var    JHttpResponse  Mock response object.
	 * @since  12.3
	 */
	protected $response;

	/**
	 * @var JGithubPackageRepositories
	 */
	protected $object;

	/**
	 * @var    string  Sample JSON string.
	 * @since  12.3
	 */
	protected $sampleString = '{"a":1,"b":2,"c":3,"d":4,"e":5}';

	/**
	 * @var    string  Sample JSON error message.
	 * @since  12.3
	 */
	protected $errorString = '{"message": "Generic Error"}';

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @since   ¿
	 *
	 * @return  void
	 */
	protected function setUp()
	{
		parent::setUp();

		$this->options  = new JRegistry;
		$this->client   = $this->getMock('JGithubHttp', array('get', 'post', 'delete', 'patch', 'put'));
		$this->response = $this->getMock('JHttpResponse');

		$this->object = new JGithubPackageRepositories($this->options, $this->client);
	}

	/**
	 * Overrides the parent tearDown method.
	 *
	 * @return  void
	 *
	 * @see     PHPUnit_Framework_TestCase::tearDown()
	 * @since   3.6
	 */
	protected function tearDown()
	{
		unset($this->options);
		unset($this->client);
		unset($this->response);
		unset($this->object);
		parent::tearDown();
	}

	/**
	 * @covers JGithubPackageRepositories::getListOwn
	 */
	public function testGetListOwn()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/user/repos?type=all&sort=full_name&direction=asc', 0, 0)
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->getListOwn(),
			$this->equalTo(json_decode($this->response->body))
		);
	}

	/**
	 * @covers JGithubPackageRepositories::getListOwn
	 *
	 * @expectedException RuntimeException
	 */
	public function testGetListOwnInvalidType()
	{
		$this->object->getListOwn('INVALID');
	}

	/**
	 * @covers JGithubPackageRepositories::getListOwn
	 *
	 * @expectedException RuntimeException
	 */
	public function testGetListOwnInvalidSortField()
	{
		$this->object->getListOwn('all', 'INVALID');
	}

	/**
	 * @covers JGithubPackageRepositories::getListOwn
	 *
	 * @expectedException RuntimeException
	 */
	public function testGetListOwnInvalidSortOrder()
	{
		$this->object->getListOwn('all', 'full_name', 'INVALID');
	}

	/**
	 * @covers JGithubPackageRepositories::getListUser
	 */
	public function testGetListUser()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/users/joomla/repos?type=all&sort=full_name&direction=asc', 0, 0)
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->getListUser('joomla'),
			$this->equalTo(json_decode($this->response->body))
		);
	}

	/**
	 * @expectedException RuntimeException
	 */
	public function testGetListUserInvalidType()
	{
		$this->object->getListUser('joomla', 'INVALID');
	}

	/**
	 * @expectedException RuntimeException
	 */
	public function testGetListUserInvalidSortField()
	{
		$this->object->getListUser('joomla', 'all', 'INVALID');
	}

	/**
	 * @expectedException RuntimeException
	 */
	public function testGetListUserInvalidSortOrder()
	{
		$this->object->getListUser('joomla', 'all', 'full_name', 'INVALID');
	}

	/**
	 * @covers JGithubPackageRepositories::getListOrg
	 */
	public function testGetListOrg()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/orgs/joomla/repos?type=all', 0, 0)
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->getListOrg('joomla'),
			$this->equalTo(json_decode($this->response->body))
		);
	}

	/**
	 * @expectedException RuntimeException
	 */
	public function testGetListOrgInvalidType()
	{
		$this->object->getListOrg('joomla', 'INVALID');
	}

	/**
	 * @covers JGithubPackageRepositories::getList
	 */
	public function testGetList()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/repositories', 0, 0)
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->getList(),
			$this->equalTo(json_decode($this->response->body))
		);
	}

	/**
	 * @covers JGithubPackageRepositories::create
	 */
	public function testCreate()
	{
		$this->response->code = 201;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('post')
			->with('/user/repos',
				'{"name":"joomla-test","description":"","homepage":"","private":false,"has_issues":false,'
					. '"has_wiki":false,"has_downloads":false,"team_id":0,"auto_init":false,"gitignore_template":""}',
				0, 0)
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->create('joomla-test'),
			$this->equalTo(json_decode($this->response->body))
		);
	}

	/**
	 * @covers JGithubPackageRepositories::get
	 */
	public function testGet()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/repos/joomla/joomla-cms', 0, 0)
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->get('joomla', 'joomla-cms'),
			$this->equalTo(json_decode($this->response->body))
		);
	}

	/**
	 * @covers JGithubPackageRepositories::edit
	 */
	public function testEdit()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('patch')
			->with('/repos/joomla/joomla-test',
				'{"name":"joomla-test-1","description":"","homepage":"","private":false,"has_issues":false,'
					. '"has_wiki":false,"has_downloads":false,"default_branch":""}', 0)
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->edit('joomla', 'joomla-test', 'joomla-test-1'),
			$this->equalTo(json_decode($this->response->body))
		);
	}

	/**
	 * @covers JGithubPackageRepositories::getListContributors
	 */
	public function testGetListContributors()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/repos/joomla/joomla-cms/contributors', 0, 0)
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->getListContributors('joomla', 'joomla-cms'),
			$this->equalTo(json_decode($this->response->body))
		);
	}

	/**
	 * @covers JGithubPackageRepositories::getListLanguages
	 */
	public function testGetListLanguages()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/repos/joomla/joomla-cms/languages', 0, 0)
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->getListLanguages('joomla', 'joomla-cms'),
			$this->equalTo(json_decode($this->response->body))
		);
	}

	/**
	 * @covers JGithubPackageRepositories::getListTeams
	 */
	public function testGetListTeams()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/repos/joomla/joomla-cms/teams', 0, 0)
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->getListTeams('joomla', 'joomla-cms'),
			$this->equalTo(json_decode($this->response->body))
		);
	}

	/**
	 * @covers JGithubPackageRepositories::getListTags
	 */
	public function testGetListTags()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/repos/joomla/joomla-cms/tags', 0, 0)
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->getListTags('joomla', 'joomla-cms'),
			$this->equalTo(json_decode($this->response->body))
		);
	}

	/**
	 * @covers JGithubPackageRepositories::getListBranches
	 */
	public function testGetListBranches()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/repos/joomla/joomla-cms/branches', 0, 0)
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->getListBranches('joomla', 'joomla-cms'),
			$this->equalTo(json_decode($this->response->body))
		);
	}

	/**
	 * @covers JGithubPackageRepositories::getBranch
	 */
	public function testGetBranch()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('get')
			->with('/repos/joomla/joomla-cms/branches/master', 0, 0)
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->getBranch('joomla', 'joomla-cms', 'master'),
			$this->equalTo(json_decode($this->response->body))
		);
	}

	/**
	 * @covers JGithubPackageRepositories::delete
	 */
	public function testDelete()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
			->method('delete')
			->with('/repos/joomla/joomla-cms', 0, 0)
			->will($this->returnValue($this->response));

		$this->assertThat(
			$this->object->delete('joomla', 'joomla-cms'),
			$this->equalTo(json_decode($this->response->body))
		);
	}
}

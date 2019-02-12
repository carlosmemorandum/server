<?php
declare(strict_types=1);
/**
 * @copyright Copyright (c) 2019, Roeland Jago Douma <roeland@famdouma.nl>
 *
 * @author Roeland Jago Douma <roeland@famdouma.nl>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OC\Core\Controller;

use OC\Core\Service\LoginFlowNgService;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\JSONResponse;
use OCP\IRequest;
use OCP\IURLGenerator;

class ClientFlowLoginNgController extends Controller {

	/** @var LoginFlowNgService */
	private $loginFlowNgService;
	/** @var IURLGenerator */
	private $urlGenerator;

	public function __construct(string $appName,
								IRequest $request,
								LoginFlowNgService $loginFlowNgService,
								IURLGenerator $urlGenerator) {
		parent::__construct($appName, $request);
		$this->loginFlowNgService = $loginFlowNgService;
		$this->urlGenerator = $urlGenerator;
	}

	public function poll(string $token): JSONResponse {

	}

	public function showAuthPickerPage() {

	}

	public function landing(string $token) {

	}

	public function grantPage() {

	}

	public function done() {

	}

	/**
	 * @NoCSRFRequired
	 * @PublicPage
	 *
	 * TODO: rate limiting
	 */
	public function init(): JSONResponse {
		//TODO: catch errors
		$tokens = $this->loginFlowNgService->createTokens();

		$data = [
			'poll' => [
				'token' => $tokens->getPollToken(),
				'endpoint' => $this->urlGenerator->linkToRouteAbsolute('core.ClientFlowLoginNg.poll')
			],
			'login' => $this->urlGenerator->linkToRouteAbsolute('core.ClientFlowLoginNg.landing', ['token' => $tokens->getLoginToken()]),
		];

		return new JSONResponse($data);
	}
}

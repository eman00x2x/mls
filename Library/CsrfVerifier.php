<?php

namespace Library;

use Pecee\Http\Middleware\BaseCsrfVerifier;

class CsrfVerifier extends BaseCsrfVerifier
{

	/**
	 * CSRF validation will be ignored on the following urls.
	 */

    function setIgnore($path) {
        $this->except[] = $path;
    }

}
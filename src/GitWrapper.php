<?php

namespace CupOfTea\GitWrapper;

use CupOfTea\Package\Package;
use CupOfTea\Package\Contracts\Package as PackageContract;

class GitWrapper implements PackageContract
{
    use Package;
    
    /**
     * Package Vendor.
     *
     * @const string
     */
    const VENDOR = 'CupOfTea';
    
    /**
     * Package Name.
     *
     * @const string
     */
    const PACKAGE = 'GitWrapper';
    
    /**
     * Package Version.
     *
     * @const string
     */
    const VERSION = '1.0.2';
}

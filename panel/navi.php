<?php
/**
 *
 * MiniGreX - designed with security in mind!
 *
 * @file    panel/navi.php
 * @package MiniGreX
 * @copyright  Volkan Kücükbudak 
 * @version 0.9 Beta
 * @license MIT
 * @link    https://github.com/VolkanSah/MiniGreX
 *
 *  Admin : Navigation
 * 
 * 
 */
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php?page=admin">Admin Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php?page=user_settings">User Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php?page=option_settings">Option Settings</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



<?php

// Single public entry point.
// UI remains in frontend/; this root file prevents the app from exposing
// the frontend directory as the first URL segment.
require __DIR__ . '/frontend/landing.php';

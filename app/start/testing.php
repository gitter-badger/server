<?php

Event::listen('illuminate.query', function($query)
{
    Log::debug($query);
});
<?php

namespace Peterjmit\BlogBundle\Model;

interface BlogManagerInterface
{
    function findAll();
    function find($id);
}

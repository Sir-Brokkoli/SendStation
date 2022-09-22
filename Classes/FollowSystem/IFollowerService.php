<?php namespace Sendstation\FollowerSystem;

interface IFollowerService {
    public function addFollowerTo(int $followerId, int $followeeId) :void;
    public function removeFollowerFrom(int $followerId, int $followeeId) :void;

    public function follows(int $followerId, int $followeeId) :bool;
    
    public function findAllFollowers(int $climberId) :array;
    public function findAllFollowees(int $climberId) :array;
}
?>
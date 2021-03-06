<?php

declare(strict_types=1);

namespace proxy;


use raklib\protocol\ACK;
use raklib\protocol\AdvertiseSystem;
use raklib\protocol\DATA_PACKET_0;
use raklib\protocol\DATA_PACKET_1;
use raklib\protocol\DATA_PACKET_2;
use raklib\protocol\DATA_PACKET_3;
use raklib\protocol\DATA_PACKET_4;
use raklib\protocol\DATA_PACKET_5;
use raklib\protocol\DATA_PACKET_6;
use raklib\protocol\DATA_PACKET_7;
use raklib\protocol\DATA_PACKET_8;
use raklib\protocol\DATA_PACKET_9;
use raklib\protocol\DATA_PACKET_A;
use raklib\protocol\DATA_PACKET_B;
use raklib\protocol\DATA_PACKET_C;
use raklib\protocol\DATA_PACKET_D;
use raklib\protocol\DATA_PACKET_E;
use raklib\protocol\DATA_PACKET_F;
use raklib\protocol\NACK;
use raklib\protocol\OpenConnectionReply1;
use raklib\protocol\OpenConnectionReply2;
use raklib\protocol\OpenConnectionRequest1;
use raklib\protocol\OpenConnectionRequest2;
use raklib\protocol\Packet;
use raklib\protocol\UnconnectedPing;
use raklib\protocol\UnconnectedPingOpenConnections;
use raklib\protocol\UnconnectedPong;

class Pool
{
    private static $packetPool = [];

    /**
     * @param $id
     *
     * @return Packet
     */
    static public function getPacketFromPool($id)
    {
        if (empty(Pool::$packetPool)) {
            Pool::registerPackets();
        }
        if (isset(Pool::$packetPool[$id])) {
            return clone Pool::$packetPool[$id];
        }
        return null;
    }

    private static function registerPackets()
    {
        Pool::registerPacket(UnconnectedPing::$ID, UnconnectedPing::class);
        Pool::registerPacket(UnconnectedPingOpenConnections::$ID, UnconnectedPingOpenConnections::class);
        Pool::registerPacket(OpenConnectionRequest1::$ID, OpenConnectionRequest1::class);
        Pool::registerPacket(OpenConnectionReply1::$ID, OpenConnectionReply1::class);
        Pool::registerPacket(OpenConnectionRequest2::$ID, OpenConnectionRequest2::class);
        Pool::registerPacket(OpenConnectionReply2::$ID, OpenConnectionReply2::class);
        Pool::registerPacket(UnconnectedPong::$ID, UnconnectedPong::class);
        Pool::registerPacket(AdvertiseSystem::$ID, AdvertiseSystem::class);
        Pool::registerPacket(DATA_PACKET_0::$ID, DATA_PACKET_0::class);
        Pool::registerPacket(DATA_PACKET_1::$ID, DATA_PACKET_1::class);
        Pool::registerPacket(DATA_PACKET_2::$ID, DATA_PACKET_2::class);
        Pool::registerPacket(DATA_PACKET_3::$ID, DATA_PACKET_3::class);
        Pool::registerPacket(DATA_PACKET_4::$ID, DATA_PACKET_4::class);
        Pool::registerPacket(DATA_PACKET_5::$ID, DATA_PACKET_5::class);
        Pool::registerPacket(DATA_PACKET_6::$ID, DATA_PACKET_6::class);
        Pool::registerPacket(DATA_PACKET_7::$ID, DATA_PACKET_7::class);
        Pool::registerPacket(DATA_PACKET_8::$ID, DATA_PACKET_8::class);
        Pool::registerPacket(DATA_PACKET_9::$ID, DATA_PACKET_9::class);
        Pool::registerPacket(DATA_PACKET_A::$ID, DATA_PACKET_A::class);
        Pool::registerPacket(DATA_PACKET_B::$ID, DATA_PACKET_B::class);
        Pool::registerPacket(DATA_PACKET_C::$ID, DATA_PACKET_C::class);
        Pool::registerPacket(DATA_PACKET_D::$ID, DATA_PACKET_D::class);
        Pool::registerPacket(DATA_PACKET_E::$ID, DATA_PACKET_E::class);
        Pool::registerPacket(DATA_PACKET_F::$ID, DATA_PACKET_F::class);
        Pool::registerPacket(NACK::$ID, NACK::class);
        Pool::registerPacket(ACK::$ID, ACK::class);
    }

    private static function registerPacket($id, $class)
    {
        Pool::$packetPool[$id] = new $class;
    }
}
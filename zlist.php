<?php

/**
 * Esse arquivo serve apenas para ajudar o VS Code a entender o Laravel.
 * Ele nunca será executado de verdade.
 */

namespace {
    function auth() {
        return new \Illuminate\Auth\AuthManager(app());
    }
}

namespace Illuminate\Contracts\Auth {
    interface Guard {
        /** @return \App\Models\User|null */
        public function user();
        public function guest();
    }
}

namespace Illuminate\Contracts\View {
    interface View {
        /**
         * @param  mixed  $provider
         * @return $this
         */
        public function withErrors($provider);
    }
}

namespace Illuminate\Contracts\Routing {
    interface ResponseFactory {
        /**
         * Meu macro personalizado para JSON.
         * * @param mixed $content
         * @return \Illuminate\Http\Response
         */
        public function myJson($content);
    }
}

namespace Illuminate\Http {
    class Response {
        /**
         * Permite reconhecer o macro quando chamado estaticamente ou encadeado.
         * * @param mixed $content
         * @return \Illuminate\Http\Response
         */
        public static function myJson($content);
    }
}
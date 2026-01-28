Inter-App Communication (Sitzungen)

Kurz: Einheitliches Event- und Callback-Modell für lose Kopplung.

Events
- Basic: Fire-and-forget.
- Callback: Sender gibt Callback mit, Empfänger ruft `triggerCallback()`.
- RequestData: Empfänger ruft `respond()` mit Daten auf.

Beispiele
- Sender:
```
$eventService->dispatchCallbackEvent(['id'=>1], function($resp){ /* ... */ });
```

- Listener:
```
public function handle(CallbackEvent $e) { $e->triggerCallback(['ok'=>true]); }
```

Versioning
- Events sind Klassen; bei Breaking-Changes neue Klassen/Versionen verwenden.

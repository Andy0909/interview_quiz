### SOLID 原則

1. **單一職責原則 (Single Responsibility Principle, SRP)**：
    - 每個類別和方法都有明確的職責。例如，`OrderController` 負責處理訂單相關的 HTTP 請求，而 `OrderService` 負責訂單的業務邏輯。

2. **開放封閉原則 (Open/Closed Principle, OCP)**：
    - 透過事件和監聽器，系統可以擴展貨幣種類而不需要修改核心邏輯。

3. **里式替換原則 (Liskov Substitution Principle, LSP)**：
    - 所有實現 `OrderServiceInterface` 和 `OrderRepositoryInterface` 的類別都可以替換其具體實現，而不會影響系統的正確性和行為。

4. **介面隔離原則 (Interface Segregation Principle, ISP)**：
    - `OrderRepository` 只包含 `OrderService` 所需的方法，而不包含其他不相關的方法。

5. **依賴反轉原則 (Dependency Inversion Principle, DIP)**：
    - 在這個專案中，`OrderService` 依賴於 `OrderRepository` 的抽象，而不是具體的實現。這樣可以提高系統的靈活性和可測試性。

### 設計模式

1. **依賴注入 (Dependency Injection)**：
    - `OrderService` 透過建構函數注入 `OrderRepository`，這是一種依賴注入的形式。這使得 `OrderService` 更加靈活和可測試。

2. **儲存庫模式 (Repository Pattern)**：
    - `OrderRepository` 負責與資料庫進行交互。這樣可以將資料存取邏輯與業務邏輯分離，提高系統的可維護性。

3. **事件驅動設計 (Event-Driven Design)**：
    - 使用事件和事件處理器來解耦系統的不同部分。例如，在 `OrderController` 中觸發 `OrderCreated` 事件，並在 `OrderCreatedListener` 中處理訂單的存儲邏輯。這樣可以提高系統的模組化和可維護性。
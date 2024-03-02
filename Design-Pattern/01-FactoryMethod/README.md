# Design Patterns > Creational Patterns > Factory Method
=> "Factory Method" mục đích là tạo và sử dụng các objects khác nhau, cùng kiểu (cùng interface) nhưng có các methods khác nhau (các action, properties khác nhau)

- Creator > Concrete Creators
- Product Type > Products

# Khả năng ứng dụng

- "Factory Method" sử dụng khi chưa biết trước chính xác các kiểu và các phụ thuộc của những objects mà code của bạn sẽ hoạt động.
=> Nó tách biệt code xây dựng "Products" và code sử dụng "Products" => Rất dễ mở rộng "Product" (Ex: Thêm 1 "Product" mới sẽ ko ảnh hưởng đến code sử dụng nó).

- "Factory Method" có thẻ mở rộng "Internal Components"

- Có thể sử dụng lại object đã tạo, không phải tạo lại.

# Ưu điểm

- Tránh sự chặt chẽ giữa "Creator" và "Concrete Products"
- Nguyên tắc chịu trách nhiệm duy nhất (Single Responsibility Principle ): Mã tạo "Product" có thể được riêng biệt, chỉ tạo "Product" thôi.
- Nguyên tắc đóng/mở (Open/Closed Principle) : Có thể mở rộng, thêm code "Product" mới mà ko ảnh hưởng đến client code hiện tại (Code Application).

# Nhược điểm

- Code phức tạp hơn, khi phải thêm nhiều SubClass để triển khai mẫu (pattern).
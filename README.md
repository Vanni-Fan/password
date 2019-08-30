## 依赖
- [PHP7](https://php.net)
- [zephir](https://github.com/phalcon/zephir)
- [Zephir Parser](https://github.com/phalcon/php-zephir-parser)

## 安装
```bash
php install.php
```

## 用途
- 用于加密数据库表中的关键字段（防止拖库）
- 用于加密配置文件中的关键信息（防止配置文件被盗）
- 加密简单快捷，所以防暴程度低，不适应要度安全要求的场景

## 特征
- 密码被编译进入 hp.so 文件不被破解，在编译时手动指定的
- 加密后的数据长度为原来数据长度的2倍（因为加密后的数据被转换成hex了，如果将它转换成原来的2进制，加密后的数据和源数据长度一致）
- 加密的数据可以用于数据库的 Like 查询（逐字加密，所以每个字加密后的数据是一致的）

## 用法
```php
# 加密
$str = Hp\Password::encode('要加密的字符串');

# 解密
$rs = Hp\Password::decode($str);

# 查询
$where = "field_a LIKE '%". Hp\Password::encode('部分字段') . "%'";
```
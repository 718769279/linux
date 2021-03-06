查找镜像
docker search httpd:2.4

拉取镜像
docker pull httpd:2.4.33

创建容器
docker run -p 8080:80 -d httpd:2.4.33
参数详解：
    -p 当前主机的端口：容器的端口
    -d 后台运行
    -v 挂载目录（当前主机的目录:容器中的某个目录）
    --name 指定容器的名称

进入容器
docker exec -it 容器名称 /bin/bash

启动容器
docker start 容器名称或者容器id

关闭容器
docker stop 容器名称或者容器id

退出容器
Ctrl+d 或者 命令行输入exit

查看本地所有镜像
docker images

删除镜像
docker rmi 镜像名称

查看正在运行的所有容器
docker ps

查看所有容器
docker ps -a

停止某个容器
docker stop 容器名称或者容器id

删除容器文件
docker container rm 容器名称或者容器id

进入正在运行的容器
docker attach 容器名称或者容器id

--------------------------------------------------------------------------
运行实例
创建es数据库
docker run --name es -d -p 9200:9200 -p 9300:9300 -e ES_JAVA_OPTS="-Xms256m -Xmx1024m" -e "discovery.type=single-node" docker.elastic.co/elasticsearch/elasticsearch:7.2.0

创建apache服务器
docker run --name apache -p 8088:80 -d httpd:2.4.33

创建centos服务器
docker run --name myCentos -it centos /bin/bash

创建自己的镜像
创建自己的镜像是基于容器创建的，而且该容器是关闭状态
docker commit -m '添加常用软件' -a 'wangwen123' 容器id wangwen123/centos:mylinux
参数说明：
-m 来指定提交的说明信息，跟我们使用的版本控制工具一样；-a 可以指定更新的用户信息；之后是用来创建镜像的容器的 ID；最后指定目标镜像的仓库名和 tag 信息

提交镜像到远程
docker login
docker push wangwen123/centos:mylinux
此时任何地方都可以拉取到自己的远程镜像了

lnmp搭建
创建mysql容器
docker run \
--name doc_mysql \
-p 3306:3306 \
--restart=always \
-e MYSQL_ROOT_PASSWORD=123456 \
-v /var/lib/mysql/:/var/lib/mysql/ \
-d mysql:latest \
--character-set-server=utf8mb4 \
--collation-server=utf8mb4_unicode_ci

创建php容器
docker run -d -v /home/wangwen/www:/var/www/html -p 9000:9000 --link doc_mysql:mysql --name doc_phpfpm php:7.3-fpm

创建nginx容器
docker run -d -p 80:80 --name doc_nginx -v /home/wangwen/www:/var/www/html --link doc_phpfpm:phpfpm nginx:latest

nginx 解析php
fastcgi_pass 容器ip或者容器名称：9000
fastcgi_params SCRIPT_FILENAME /var/www/html$fastcgi_script_name;

安装php扩展，进入php容器 执行docker-php-ext-install mysqli

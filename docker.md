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

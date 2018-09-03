#!groovy

pipeline {
    agent any

    environment {
        LINE_NOTIFY_ACCESS_TOKEN = "${env.LINE_NOTIFY_ACCESS_TOKEN}"
    }

    stages {
        stage ('composer install') {
            steps {
                bat 'composer install'
            }
        }
        stage("phpunit") {
            steps {
                runUnitTest()
            }
        }
    }
    post {
        always {
            junit 'results/phpunit/phpunit.xml'
        }
    }
}

def runUnitTest(){
    try{
        bat 'vendor/bin/phpunit'
        notifyLINE("${LINE_NOTIFY_ACCESS_TOKEN}",true) 
    }catch (err) {
        echo 'error :'+err
        notifyLINE("${LINE_NOTIFY_ACCESS_TOKEN}",false)
        throw err
    }
}

def notifyLINE(token, result) {
    //def isFailure = result == 'FAILURE'
    def useSticker = true
      
    def url = 'https://notify-api.line.me/api/notify'
    def message = "Build Master, result is ${result}. ${env.BUILD_URL}"
    def stickerPackageId = 1
    def stickerId = 14

    if (result == false){
        stickerId = 100
    }

    def batCmd = "curl -X POST -H \"Authorization: Bearer ${token}\" -F \"message=${message}\" ${url}"
    if(useSticker == true){
        batCmd = "curl -X POST -H \"Authorization: Bearer ${token}\" -F \"message=${message}\" -F \"stickerPackageId=${stickerPackageId}\" -F \"stickerId=${stickerId}\" ${url}"
    }
    
    bat batCmd
}
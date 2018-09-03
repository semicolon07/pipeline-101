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
        stage('deploy'){
            steps{
                deploy()
            }
        }
    }
    post {
        always {
            junit 'results/phpunit/phpunit.xml'
        }
    }
}

def deploy(){
    def fParams = " -F \"message=Staring deploy to Heroku...\""
    notifyLINE(fParams)

    bat 'git push heroku master'

    def url = bat('heroku apps:info -s  | grep web_url | cut -d= -f2')
    fParams = " -F \"message=Success deploy to Heroku URL => ${url} \""
    notifyLINE(fParams)
}

def runUnitTest(){
    try{
        bat 'vendor/bin/phpunit'
        notifyLINE_BuildResult(true) 
    }catch (err) {
        echo 'error :'+err
        notifyLINE_BuildResult(false)
        throw err
    }
}

def notifyLINE_BuildResult(result) {
    def message = "Build Master, result is ${result}. ${env.BUILD_URL}"
    def stickerPackageId = 1
    def stickerId = 14

    if (result == false){
        stickerId = 100
    }

    def fParams = " -F \"message=${message}\" -F \"stickerPackageId=${stickerPackageId}\" -F \"stickerId=${stickerId}\" "
    notifyLINE(fParams)
}

def notifyLINE(f_params){
    def url = 'https://notify-api.line.me/api/notify'
    def batCmd = "curl -X POST -H \"Authorization: Bearer ${LINE_NOTIFY_ACCESS_TOKEN}\" ${f_params} ${url}"
    bat batCmd
}
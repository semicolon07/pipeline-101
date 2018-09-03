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
    notify("Deploy to staging?")
    input 'Deploy to staging?'
    def fParams = " -F \"message=Staring deploy to Heroku...\""
    notifyLINE(fParams)

    git branch: 'master', url:  'https://github.com/semicolon07/pipeline-101.git'
    bat 'git push heroku master'
    //bat 'heroku ps:scale web=1'
    //def url = bat(returnStdout: true, script: 'heroku apps:info -s  | grep web_url | cut -d= -f2')
    def url = "http://google.co.th"
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

def notify(status){
    emailext (
      to: "nice.comsci@gmail.com",
      subject: "${status}: Job '${env.JOB_NAME} [${env.BUILD_NUMBER}]'",
      body: """<p>${status}: Job '${env.JOB_NAME} [${env.BUILD_NUMBER}]':</p>
        <p>Check console output at <a href='${env.BUILD_URL}'>${env.JOB_NAME} [${env.BUILD_NUMBER}]</a></p>""",
    )
}
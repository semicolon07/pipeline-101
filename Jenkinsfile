#!groovy
pipeline {
    agent any

    stages {
        stage ('Compile Stage') {
            steps {
                bat 'composer install'
            }
        }
        stage("phpunit") {
            steps {
                bat 'vendor/bin/phpunit'
            }
        }
        stage ('Notify'){
            steps {
                notifyLINE('ttPnrcjWXfANDVNYyMTccxG81J5UYxvNuwyDjXJATGk','SUCCESS')
            }
        }
    }
    post {
        always {
            junit 'results/phpunit/phpunit.xml'
        }
    }
}

def notifyLINE(token, result) {
    def isFailure = result == 'FAILURE'
    def useSticker = true
      
    def url = 'https://notify-api.line.me/api/notify'
    def message = "Build Master, result is ${result}. ${env.BUILD_URL}"
    def stickerPackageId = 1
    def stickerId = 1

    def batCmd = "curl -X POST -H \"Authorization: Bearer ${token}\" -F \"message=${message}\" ${url}"
    if(useSticker == true){
        batCmd = "curl -X POST -H \"Authorization: Bearer ${token}\" -F \"message=${message}\" -F \"stickerPackageId=${stickerPackageId}\" -F \"stickerId=${stickerId}\" ${url}"
    }
    
    bat batCmd
}
pipeline {
    agent any
    environment {
        lineApi = "https://notify-api.line.me/api/notify"
    }

    stages {
        stage ('Compile Stage') {

            steps {
                echo 'Compile Stage'

            }
        }

        stage ('Testing Stage') {

            steps {
                echo 'Testing Stage'
            }
        }

        stage ('Deployment Stage') {
            steps {
                echo 'Deployment Stage'
                currentBuild.result = 'SUCCESS'
            }
        }
        stage ('Notify'){
            steps {
                notifyLINE('ttPnrcjWXfANDVNYyMTccxG81J5UYxvNuwyDjXJATGk',currentBuild.result)
                //bat "curl -X POST -H \"Authorization: Bearer ttPnrcjWXfANDVNYyMTccxG81J5UYxvNuwyDjXJATGk\" -F \"message=helloworld\" ${lineApi}"
            }
        }
    }
}

def notifyLINE(token, result) {
    def isFailure = result == 'FAILURE'
      
    def url = 'https://notify-api.line.me/api/notify'
    def message = "Build ${env.BRANCH_NAME}, result is ${result}. \n${env.BUILD_URL}"
    def imageThumbnail = isFailure ? 'FAILED_IMAGE_THUMBNAIL' : ''
    def imageFullsize = isFailure ? 'FAILED_IMAGE_FULLSIZE' : ''
      
    bat "curl ${url} -H 'Authorization: Bearer ${token}' -F 'message=${message}'   
    -F 'imageThumbnail=${imageThumbnail}' -F 'imageFullsize=${imageFullsize}'"
}
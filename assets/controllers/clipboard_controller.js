import { Application } from '@hotwired/stimulus'
import Clipboard from '@stimulus-components/clipboard'

const application = Application.start()
application.register('clipboard', Clipboard)
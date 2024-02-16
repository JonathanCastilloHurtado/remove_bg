import rembg
import numpy as np
from PIL import Image
import os.path

 
from rembg import remove
import cv2 
# Load the input image
input_image = Image.open('img.jpg')

# Convert the input image to a numpy array
input_array = np.array(input_image)

# Apply background removal using rembg
output_array = rembg.remove(input_array)

# Create a PIL Image from the output array
output_image = Image.fromarray(output_array)

im = output_image


removeim = remove(im,bgcolor=[255,255,255,255])

rgb_im = removeim.convert('RGB')
rgb_im.save('output_image.jpg')

isFile= os.path.isfile('output_image.jpg')
print(isFile) 
